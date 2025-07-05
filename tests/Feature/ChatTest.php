<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\Message;
use Database\Seeders\MessageTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    /**
    * このテストは、ログインユーザーが100文字のメッセージを
    * チャットルーム（ID=1）に投稿できることを検証します。
    *
    * - 正常にPOSTできること（HTTPステータス302を返す）
    * - メッセージがmessagesテーブルに正しく保存されていること
    */
    public function test_can_post_100_character_message() 
    {
        // テスト用のユーザーを作成
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // テスト用のチャットルームをID=1で作成
        $room = ChatRoom::factory()->create(['id' => 1]);

        $message = str_repeat('あ', 100);

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
    * このテストは、ログインユーザーが空文字のメッセージを
    * チャットルーム（ID=1）に投稿できないことを検証します。
    *
    * - 正常にPOSTできないこと（HTTPステータス302を返す）
    * - メッセージは必須です。のエラーメッセージが表示されること。
    */
    public function test_message_validation_empty_string() 
    {   
        // user変数にはUserのインスタンスが入る
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // テスト用のチャットルームをID=1で作成
        ChatRoom::factory()->create(['id' => 1]);

        //空文字でメッセージを送信
        $response = $this->actingAs($user)->post('/chat', [
            'message' => '',
        ]);

        $response->assertStatus(302);

        // セッションにエラーメッセージが含まれていることを確認
        $response->assertSessionHasErrors(['message']);

        // 実際のエラーメッセージの中身を確認（文字列一致）
        $errors = session('errors');
        $this->assertTrue($errors->get('message')[0] === 'メッセージは必須です。');
    }

    /**
    * このテストは、ログインユーザーが101文字以上ののメッセージを
    * チャットルーム（ID=1）に投稿できないことを検証します。
    *
    * - 正常にPOSTできないこと（HTTPステータス302を返す）
    * - メッセージは100文字以内で入力してください。のエラーメッセージが表示されること。
    */
    public function test_message_validation_max() 
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // テスト用のチャットルームをID=1で作成
        ChatRoom::factory()->create(['id' => 1]);

        $message = str_repeat('あ', 101);
        
        // ユーザーとしてログインした状態で、チャット投稿用のPOSTリクエストを送信
        $response = $this->actingAs($user)->post('/chat', [
            'message' => $message,
        ]);

        $response->assertStatus(302);

        // セッションにエラーメッセージが含まれていることを確認
        $response->assertSessionHasErrors(['message']);

        // 実際のエラーメッセージの中身を確認
        $errors = session('errors');
        $this->assertTrue($errors->get('message')[0] === 'メッセージは100文字以内で入力してください。');
    }

    /**
    * このテストは、ログインユーザーがnull値のメッセージを
    * チャットルーム（ID=1）に投稿できないことを検証します。
    *
    * - 正常にPOSTできないこと（HTTPステータス302を返す）
    * - メッセージは必須です。のエラーメッセージが表示されること。
    */
    public function test_message_validation_null() 
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // テスト用のチャットルームをID=1で作成
        ChatRoom::factory()->create(['id' => 1]);

        //空文字でメッセージを送信
        $response = $this->actingAs($user)->post('/chat', [
            'message' => null,
        ]);

        $response->assertStatus(302);

        // セッションにエラーメッセージが含まれていることを確認
        $response->assertSessionHasErrors(['message']);

        // 実際のエラーメッセージの中身を確認（文字列一致）
        $errors = session('errors');
        $this->assertTrue($errors->get('message')[0] === 'メッセージは必須です。');
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
        // 投稿対象のチャットルームを作成
        ChatRoom::factory()->create(['id' => 1]);

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
        // ユーザー・チャットルーム・メッセージの準備
        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $room = ChatRoom::factory()->create(['id' => 1]);

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
        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);

        // 表示順を確認（昇順で並んでいること）
        $expectedMessages = collect(range(1, 10))->map(fn($i) => "テストメッセージ{$i}")->toArray();
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
        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // 2ページ目にアクセス（?page=2）
        $response = $this->actingAs($user)->get('/chat?page=2');

        $response->assertStatus(200);

        // ページ2に表示される 11〜15 件目の順序を確認
        $expectedMessages = collect(range(11, 15))
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
        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // `/chat`（クエリパラメータなし）にアクセス
        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);

        // 表示されているのが 1〜10 のメッセージであることを確認
        $expectedMessages = collect(range(1, 10))
            ->map(fn($i) => "テストメッセージ{$i}")
            ->toArray();

        $response->assertSeeInOrder($expectedMessages);

        // 11〜15件は含まれていないことを確認
        foreach (range(11, 15) as $i) {
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
        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class);
        
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // 1ページ目にアクセス
        $response = $this->actingAs($user)->get('/chat');

        $response->assertStatus(200);

        // 1〜10件目が表示されることを確認
        foreach (range(1, 10) as $i) {
            $response->assertSee("テストメッセージ{$i}");
        }

        // 11件目以降は表示されないことを確認
        foreach (range(11, 15) as $i) {
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
        // 15件のメッセージを用意（Seederで）
        $this->seed(MessageTestSeeder::class); 
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // 2ページ目にアクセス
        $response = $this->actingAs($user)->get('/chat?page=2');

        $response->assertStatus(200);

        // 11〜15件目が表示されることを確認
        foreach (range(11, 15) as $i) {
            $response->assertSee("テストメッセージ{$i}");
        }

        // 1〜10件目は表示されないことを確認
        $response->assertDontSeeText("テストメッセージ 1");
        foreach (range(2, 10) as $i) {
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
