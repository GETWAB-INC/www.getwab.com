<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use App\Models\BillingRecord;
use App\Models\ReportPackage;

class BillingService
{
    public function processSubscriptions(): array
    {
        $results = [
            'success' => true,
            'messages' => [],
        ];

        // Session keys we expect
        $sessionKeys = [
            'fpds_query_trial',
            'fpds_query_subscription',
            'fpds_report_subscription',
        ];

        foreach ($sessionKeys as $sessionKey) {
            $data = Session::get($sessionKey);

            if (!$data) {
                $results['messages'][] = "No data for subscription (key: {$sessionKey})";
                continue;
            }

            try {
                DB::transaction(function () use ($data, $sessionKey, &$results) {

                    // 1. Create a billing record
                    $billingRecord = BillingRecord::createRecord($data);

                    // 2. Add billing record ID to $data for the subscription
                    $data['billing_record_id'] = $billingRecord->id;

                    // 3. Create or update subscription
                    Subscription::store($data);

                    // 4. Clear session data
                    Session::forget($sessionKey);

                    // 5. Build a message using the session key as a descriptor
                    $results['messages'][] =
                        "Subscription '{$sessionKey}' and billing record #{$billingRecord->id} created successfully.";
                });
            } catch (\Exception $e) {
                $results['success'] = false;
                $results['messages'][] = "Failed to process subscription (key: {$sessionKey}): {$e->getMessage()}";
            }
        }

        return $results;
    }

    public function processReportPackage(): array
    {
        $results = [
            'success' => true,
            'messages' => [],
        ];

        // Session keys for report packages
        $sessionKeys = [
            'elementary_report_package',
            'composite_report_package'
        ];

        foreach ($sessionKeys as $sessionKey) {
            $data = Session::get($sessionKey);

            if (!$data) {
                $results['messages'][] = "No data for report package (key: {$sessionKey})";
                continue;
            }

            try {
                DB::transaction(function () use ($data, $sessionKey, &$results) {

                    // 1. Look for an existing package for the user
                    $existingPackage = ReportPackage::where('user_id', auth()->id())
                        ->where('package_type', $data['package_type'])
                        ->first();

                    if ($existingPackage) {
                        // 2a. If the package exists, increase remaining_reports
                        $existingPackage->remaining_reports += $data['reports_count'];
                        $existingPackage->save();

                        // 2b. Create a billing record (to track the payment)
                        $billingRecord = BillingRecord::createRecord([
                            'package_type' => $data['package_type'],
                            'reports_count' => $data['reports_count'],
                            'package_price' => $data['package_price'],
                        ]);

                        $results['messages'][] =
                            "Existing '{$data['package_type']}' package updated: +{$data['reports_count']} reports. Billing record #{$billingRecord->id} created.";
                    } else {
                        // 2c. If the package does not exist, create a new record
                        $billingRecord = BillingRecord::createRecord([
                            'package_type' => $data['package_type'],
                            'reports_count' => $data['reports_count'],
                            'package_price' => $data['package_price'],
                        ]);

                        $reportPackage = ReportPackage::create([
                            'user_id' => auth()->id(),
                            'billing_record_id' => $billingRecord->id,
                            'package_type' => $data['package_type'],
                            'remaining_reports' => $data['reports_count'], // initial amount
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $results['messages'][] =
                            "New '{$data['package_type']}' package created with {$data['reports_count']} reports. Billing record #{$billingRecord->id} created.";
                    }

                    // 3. Clear session data
                    Session::forget($sessionKey);
                });
            } catch (\Exception $e) {
                $results['success'] = false;
                $results['messages'][] = "Failed to process report package (key: {$sessionKey}): {$e->getMessage()}";
            }
        }

        return $results;
    }
}
