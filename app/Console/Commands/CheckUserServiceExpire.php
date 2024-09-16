<?php

namespace App\Console\Commands;

use App\Enum\ServicesStatusType;
use App\Enum\ServicesType;
use App\Mail\ServiceAboutToEndMail;
use App\Mail\ServiceEndedMail;
use App\Models\User;
use Illuminate\Console\Command;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckUserServiceExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-user-service-expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks if active user services have expired or are about to expire based on duration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve all tenants
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            // Set the tenant as the current tenant for multitenancy
            $tenant->makeCurrent();

            // Retrieve users who have active services
            $users = User::whereHas('services', function($query) {
                // Fetch users with active services only
                $query->where('status', ServicesStatusType::ACTIVE);
            })->get();

            // Get today's date
            $today = Carbon::today();

            // Iterate through users and check for expired and about-to-expire services
            foreach ($users as $user) {
                foreach ($user->services()->where('status', ServicesStatusType::ACTIVE)->get() as $service) {
                    // Calculate expiration based on the service type (monthly or yearly)
                    $expiryDate = null;

                    if ($service->type === ServicesType::MONTHLY->value) {
                        // Add duration in months to the created_at timestamp
                        $expiryDate = Carbon::parse($service->created_at)->addMonths($service->duration);
                    } elseif ($service->type === ServicesType::YEARLY->value) {
                        // Add duration in years to the created_at timestamp
                        $expiryDate = Carbon::parse($service->created_at)->addYears($service->duration);
                    }

//                    $daysUntilExpiry = $today->diffInDays($expiryDate, false);

                    // Check if the service is about to expire (e.g., within the next 7 days)
//                    if ($daysUntilExpiry <= 7) {
//                        // Send notification about the service ending soon
////                        Mail::to($user->email)->send(new ServiceAboutToEndMail($user,$service, $expiryDate->format('Y-m-d')));
//                        $this->info("Notification sent to {$user->name} for service '{$service->title}' ending on {$expiryDate->format('Y-m-d')}.");
//                    }

                    if ($expiryDate && $expiryDate->isPast()) {
                        // If the service has expired, update its status to EXPIRED
                        $service->update(['status' => ServicesStatusType::EXPIRED]);

                        // Check for an inactive service that can act as a replacement
                        $replacementService = $user->services()
                            ->where('status', ServicesStatusType::INACTIVE)
                            ->first(); // Assuming only one inactive service should be considered

                        if ($replacementService) {
                            // Update the replacement service to active and change the created_at to current date
                            $replacementService->update([
                                'status' => ServicesStatusType::ACTIVE,
                                'created_at' => Carbon::now() // Set the created_at to the current date
                            ]);

                            $this->info("Replacement service '{$replacementService->title}' activated for user {$user->name}.");
                        } else {
                            // Log that no replacement service was found
                            $this->info("No replacement service found for user {$user->name} after '{$service->title}' expired.");
                        }

                        // Optionally: Send notification about the expired service
                        // Mail::to($user->email)->send(new ServiceEndedMail($service));
                        $this->info("Notification sent to {$user->name} for service '{$service->title}' that has expired.");
                    }


                }
            }
        }
    }
}
