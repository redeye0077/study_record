<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;
use Database\Seeders\MessageTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Utils\TestDataHelper;

class ChatTest extends TestCase
{
    use RefreshDatabase;
    use TestDataHelper;

    /**
    * このテストは、ログインユーザーが100文字のメッセージを
    * チャットルーム（ID=1）に投稿できることを検証します。
    *
    * - 正常にPOSTできること（HTTPステータス302を返す）
    * - メッセージがmessagesテーブルに正しく保存されていること
    */
    public function test_can_post_100_character_message() 
    {
        [$user, $room] = $this->createUserAndChatRoom();

        // メッセージが入力できる最大文字数
        $message_max_length = config('chat.message.max_length');

        $message = str_repeat('あ', $message_max_length);

        // ユーザーとしてログインした状態で、チャット投稿用のPOSTリクエストを送信
        $response = $this->actingAs($user)->post('/chat', [
            'message' => $message,
        ]);

        // リダイレクト（302）されることを確認（正常に投稿されたことを意味する）
        $response->assertStatus(302);

        // メッセージがデータベースに正しく保存されていることを確認
        $this->assertDatabaseHas('messages', [
            'user_id' => $user->id,
            'chat_room_id' => $room->id,
            'message' => $message,
        ]);
    }

    /**
    *　@dataProvider invalidMessageProvider
    *　バリデーションエラーのテスト検証
    */
    public function test_message_validation($input, string $expectedError) 
    {
        [$user, $room] = $this->createUserAndChatRoom();
        
        // ユーザーとしてログインした状態で、チャット投稿用のPOSTリクエストを送信
        $response = $this->actingAs($user)->post('/chat', [
            'message' => $input,
        ]);

        $response->assertStatus(302);

        // セッションにエラーメッセージが含まれていることを確認
        $response->assertSessionHasErrors(['message']);

        // 実際のエラーメッセージの中身を確認
        $errors = session('errors');
        $this->assertSame($expectedError, $errors->get('message')[0]);
    }

    public static function invalidMessageProvider(): array
    {
        // 101文字以上は入力できないことを確かめるため101に設定
        $message_over_length = 101;

        return [
            '空文字はNG' => ['', 'メッセージは必須です。'],
            'nullはNG' => [null, 'メッセージは必須です。'],
            '101文字はNG' => [str_repeat('あ', $message_over_length), 'メッセージは100文字以内で入力してください。'],
        ];
    }

    /**
    * このテストは、未ログインユーザーがメッセージを
    * チャットルーム（ID=1）に投稿しようとしたら、
    * ログインページにリダイレクトされることを検証します。
    *
    * - 正常にPOSTできないこと（HTTPステータス302を返す）
    * - ログインページにリダイレクトされること。
    */
    public function test_not_login_user() 
    {
        // 認証なしでメッセージ投稿を試みる
        $response = $this->post('/chat', [
            'message' => '未ログイン投稿',
        ]);
        
        $response->assertStatus(302);

        // ログインページにリダイレクトされることを確認
        $response->assertRedirect('/login');
    }

    /**
    * このテストは、ログインユーザーが掲示板画面にアクセスしたとき
    * ステータス200、期待されるメッセージ一覧が表示されることを検証します。
    *
    * - 掲示板画面が正常に表示されること（HTTPステータス200を返す）
    * - messagesテーブルに正しく保存されているメッセージが正しく表示されること
    */
    public function test_message_list_display() 
    {

        [$user, $room] = $this->createUserAndChatRoom();
        $otherUser = User::factory()->create();

        // メッセージを2件作成（ユーザーが投稿したものと他ユーザーのもの）
        $message1 = Message::factory()->create([
            'chat_room_id' => $room->id,
            'user_id' => $user->id,
            'message' => 'こんにちは！',
        ]);

        $message2 = Message::factory()->create([
            'chat_room_id' => $room->id,
            'user_id' => $otherUser->id,
            'message' => 'これは他のユーザーのメッセージです。',
        ]);

        // ログイン状態で /chat にアクセス
        $response = $this->actingAs($user)->get('/chat');

        // ステータス200（成功）を確認
        $response->assertStatus(200);

        // メッセージ内容がページに表示されていることを確認
        $response->assertSeeText($message1->message);
        $response->assertSeeText($message2->message);
    }

    /**
    * このテストは、掲示板画面にアクセスした時、
    * メッセージが投稿日時の昇順（古い順）で取得されていることを検証します。
    * (1ページ目)
    * - 表示順を確認（昇順で並んでいること）（HTTPステータス200を返す）
    * - messagesテーブルに正しく保存されているメッセージが正しく表示されること
    */
    public function test_message_created_at_asc_1_page()
    {
        [$user, $room] = $this->createUserAndChatRoom();
        $firstPageStart = config('chat.test.first_page.start');
        $firstPageEnd = config('chat.test.first_page.end');

        // Seeder を呼び出してデータを作成
        $seeder = new \Database\Seeders\MessageTestSeeder();
        $seeder->runWithUserAndRoom($user, $room);

        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);

        // 表示順を確認（昇順で並んでいること）
        $expectedMessages = collect(range($firstPageStart, $firstPageEnd))->map(fn($i) => "テストメッセージ{$i}")->toArray();
        $response->assertSeeInOrder($expectedMessages);
    }

    /**
    * このテストは、掲示板画面にアクセスした時、
    * メッセージが投稿日時の昇順（古い順）で取得されていることを検証します。
    * (2ページ目)
    * - 表示順を確認（昇順で並んでいること）（HTTPステータス200を返す）
    * - messagesテーブルに正しく保存されているメッセージが正しく表示されること
    */
    public function test_message_created_at_asc_2_page()
    {
        [$user, $room] = $this->createUserAndChatRoom();
        $secondPageStart = config('chat.test.second_page.start');
        $secondPageEnd = config('chat.test.second_page.end');

        // Seeder を呼び出してデータを作成
        $seeder = new \Database\Seeders\MessageTestSeeder();
        $seeder->runWithUserAndRoom($user, $room);

        $response = $this->actingAs($user)->get('/chat');

        // 2ページ目にアクセス（?page=2）
        $response = $this->actingAs($user)->get('/chat?page=2');

        $response->assertStatus(200);

        // ページ2に表示される 11〜15 件目の順序を確認
        $expectedMessages = collect(range($secondPageStart, $secondPageEnd))
            ->map(fn($i) => "テストメッセージ{$i}")
            ->toArray();

        $response->assertSeeInOrder($expectedMessages);
    }

    /**
    * このテストは、ページネーション機能で、
    * 1ページで10件表示されることを検証します（HTTPステータス200を返す）
    * - 1ページにつき10件メッセージが表示されること
    */
    public function test_chat_default_page()
    {
        $firstPageStart = config('chat.test.first_page.start');
        $firstPageEnd = config('chat.test.first_page.end');
        $secondPageStart = config('chat.test.second_page.start');
        $secondPageEnd = config('chat.test.second_page.end');

        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);

        $user = User::first();

        // `/chat`（クエリパラメータなし）にアクセス
        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);

        // 表示されているのが 1〜10 のメッセージであることを確認
        $expectedMessages = collect(range($firstPageStart, $firstPageEnd))
            ->map(fn($i) => "テストメッセージ{$i}")
            ->toArray();

        $response->assertSeeInOrder($expectedMessages);

        // 11〜15件は含まれていないことを確認
        foreach (range($secondPageStart, $secondPageEnd) as $i) {
            $response->assertDontSee("テストメッセージ{$i}");
        }
    }

    /**
    * このテストは、ページネーション機能で、
    * 1ページで10件表示されることを検証します（HTTPステータス200を返す）
    * - 1ページにつき10件メッセージが表示されること
    */
    public function test_1_page_10_messages()
    {
        $firstPageStart = config('chat.test.first_page.start');
        $firstPageEnd = config('chat.test.first_page.end');
        $secondPageStart = config('chat.test.second_page.start');
        $secondPageEnd = config('chat.test.second_page.end');

        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);
        
        $user = User::first();

        // 1ページ目にアクセス
        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);

        // 1〜10件目が表示されることを確認
        foreach (range($firstPageStart, $firstPageEnd) as $i) {
            $response->assertSee("テストメッセージ{$i}");
        }

        // 11件目以降は表示されないことを確認
        foreach (range($secondPageStart, $secondPageEnd) as $i) {
            $response->assertDontSee("テストメッセージ{$i}");
        }
    }

    /**
    * このテストは、最終ページで件数が10件未満のときでも
    * 正しく表示されることを検証します（HTTPステータス200を返す）
    * - 全体で15件の時、2ページ目で11〜15件目が表示されること
    */
    public function test_page_parameter()
    {
        // 1ページ目の2件目のメッセージを設定
        $firstPageSecond = config('chat.test.first_page.second');
        $firstPageEnd = config('chat.test.first_page.end');
        $secondPageStart = config('chat.test.second_page.start');
        $secondPageEnd = config('chat.test.second_page.end');

        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);

        $user = User::first();

        // 2ページ目にアクセス
        $response = $this->actingAs($user)->get('/chat?page=2');

        $response->assertStatus(200);

        // 11〜15件目が表示されることを確認
        foreach (range($secondPageStart, $secondPageEnd) as $i) {
            $response->assertSee("テストメッセージ{$i}");
        }

        // 1〜10件目は表示されないことを確認
        $response->assertDontSeeText("テストメッセージ 1");
        foreach (range($firstPageSecond, $firstPageEnd) as $i) {
            $response->assertDontSee("テストメッセージ{$i}");
        }
    }

    /**
    * このテストは、未ログインユーザーが 掲示板画面(/chat) にGETアクセスした場合、
    * ログイン画面にリダイレクトされることを検証します。(ステータス302を返す)
    * - 未ログインユーザーが 掲示板画面(/chat) にGETアクセスした時、
    * ログイン画面にリダイレクトされていること
    */
    public function test_guest_cannot_access_chat_page()
    {
        // 未ログイン状態でGETアクセス
        $response = $this->get('/chat');

        // ステータス302でリダイレクトされることを確認
        $response->assertStatus(302);

        // リダイレクト先がログイン画面であることを確認
        $response->assertRedirect('/login');
    }
}
