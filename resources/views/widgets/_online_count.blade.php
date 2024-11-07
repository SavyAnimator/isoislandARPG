   Players Online: {{ App\Models\User\User::where('last_seen', '>=', Carbon\Carbon::now()->subMinutes(5))->count() }} <i class="fas fa-circle text-ilgreen mr-2"></i>
