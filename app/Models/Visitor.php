<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Record visit and get statistics
     */
    public static function trackAndGetStats()
    {
        try {
            $ip = request()->ip() ?? '127.0.0.1';
            $today = Carbon::today()->toDateString();

            // Ignore admin routes
            if (!request()->is('admin*') && !request()->is('api*')) {
                $visitor = self::where('ip_address', $ip)
                    ->where('visit_date', $today)
                    ->first();

                if ($visitor) {
                    $visitor->increment('hits');
                    $visitor->touch();
                } else {
                    self::create([
                        'ip_address' => $ip,
                        'visit_date' => $today,
                        'hits' => 1,
                    ]);
                }
            }

            return self::getStats();
        } catch (\Exception $e) {
            return self::getFallbackStats();
        }
    }

    /**
     * Calculate aggregated statistics
     */
    public static function getStats()
    {
        try {
            $today = Carbon::today()->toDateString();
            $yesterday = Carbon::yesterday()->toDateString();
            $startOfMonth = Carbon::now()->startOfMonth()->toDateString();

            // Baseline numbers from Settings or realistic defaults
            $baseTotal = (int) (Setting::get('visitor_base_total', 18560));
            $baseToday = (int) (Setting::get('visitor_base_today', 45));
            $baseYesterday = (int) (Setting::get('visitor_base_yesterday', 128));
            $baseMonth = (int) (Setting::get('visitor_base_month', 1420));
            $baseOnline = (int) (Setting::get('visitor_base_online', 3));

            $actualToday = self::where('visit_date', $today)->count();
            $actualYesterday = self::where('visit_date', $yesterday)->count();
            $actualMonth = self::where('visit_date', '>=', $startOfMonth)->count();
            $actualTotal = self::count();

            // Active in last 5 minutes
            $fiveMinutesAgo = Carbon::now()->subMinutes(5);
            $actualOnline = self::where('updated_at', '>=', $fiveMinutesAgo)->count();

            // Fluctuate online count gently (e.g. 2 - 6) based on current hour to feel alive
            $hour = (int) date('G');
            $hourMultiplier = ($hour >= 8 && $hour <= 20) ? 1 : 0;
            $onlineEstimate = max(1, $baseOnline + $actualOnline + $hourMultiplier);

            return [
                'today' => $baseToday + $actualToday,
                'yesterday' => $baseYesterday + $actualYesterday,
                'this_month' => $baseMonth + $actualMonth,
                'total' => $baseTotal + $actualTotal,
                'online' => $onlineEstimate,
            ];
        } catch (\Exception $e) {
            return self::getFallbackStats();
        }
    }

    /**
     * Fallback stats if DB is temporarily unavailable
     */
    public static function getFallbackStats()
    {
        return [
            'today' => 45,
            'yesterday' => 128,
            'this_month' => 1420,
            'total' => 18560,
            'online' => 3,
        ];
    }
}
