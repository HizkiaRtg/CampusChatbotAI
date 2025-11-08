<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupProjectFiles extends Command
{
    protected $signature = 'project:backup';
    protected $description = 'Copy selected Laravel files into backup folder automatically';

    public function handle()
    {
        $files = [
            'routes/web.php',
            'database_schema.sql',
            'app/Models/TrainingData.php',
            'app/Models/User.php',
            'app/Models/Keyword.php',
            'app/Models/ChatHistory.php',
            'app/Http/Kernel.php',
            'app/Http/Controllers/AuthController.php',
            'app/Http/Controllers/ChatHistoryController.php',
            'app/Http/Controllers/KeywordController.php',
            'app/Http/Controllers/TrainingDataController.php',
            'app/Http/Controllers/AdminController.php',
            'app/Http/Controllers/ChatbotController.php',
            'app/Http/Middleware/AdminMiddleware.php',
            'resources/views/chatbot/index.blade.php',
            'resources/views/admin/training-data/index.blade.php',
            'resources/views/admin/training-data/create.blade.php',
            'resources/views/admin/training-data/edit.blade.php',
            'resources/views/admin/keywords/index.blade.php',
            'resources/views/admin/chat-history/index.blade.php',
            'resources/views/admin/dashboard.blade.php',
            'resources/views/layouts/app.blade.php',
            'resources/views/layouts/admin.blade.php',
            'resources/views/auth/register.blade.php',
            'resources/views/auth/login.blade.php',
        ];

        foreach ($files as $path) {
            $fullPath = base_path($path);
            $dir = dirname($fullPath);

            // create directory if not exist
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            // skip if file already exists
            if (!File::exists($fullPath)) {
                File::put($fullPath, "<?php\n\n// Auto-generated: {$path}\n");
                $this->info("✅ Created: {$path}");
            } else {
                $this->warn("⚠️ Already exists: {$path}");
            }
        }

        $this->info("\n🎉 All files have been generated successfully!");
    }
}
