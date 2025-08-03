<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Mail\ExamReminderMail;
use Illuminate\Support\Facades\Mail;

class SendExamReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:exam {date} {subject}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send exam reminder emails to all students.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $examDate = $this->argument('date');
        $subject = $this->argument('subject');

        $students = Student::all();

        foreach ($students as $student) {
            Mail::to($student->email)->send(new ExamReminderMail($student, $examDate, $subject));
        }

        $this->info('Exam reminders sent successfully!');
    }
}
