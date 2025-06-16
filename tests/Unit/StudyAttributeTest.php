<?php

use Tests\TestCase;
use App\Models\Study;

class StudyAttributeTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_set_study_time_converts_minutes_to_seconds()
    {
        $study = new Study();
        $study->study_time = 90; // 90分を代入

        $this->assertEquals(5400, $study->getAttributes()['study_time']);
    }

    public function test_get_study_time_converts_seconds_to_minutes()
    {
        $study = new Study();
        $study->setRawAttributes(['study_time' => 600]);

        $this->assertEquals(10, $study->study_time);
    }
}
