<?php
// File: Created automatically by Laravel Sanctum
// You don't need to create this migration manually
// It's created when you run: php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('personal_access_tokens', function (Blueprint $table) {
        $table->id();
        $table->morphs('tokenable'); // Already includes the index
        $table->string('name');
        $table->string('token', 64)->unique();
        $table->text('abilities')->nullable();
        $table->timestamp('last_used_at')->nullable();
        $table->timestamp('expires_at')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};

/**
 * LOGIC EXPLANATION:
 * 
 * Purpose: Store API authentication tokens (Laravel Sanctum)
 * 
 * What is Laravel Sanctum?
 * Sanctum is Laravel's official package for API authentication.
 * It provides a simple way to authenticate users via tokens.
 * 
 * Why do we need tokens?
 * 
 * Traditional web apps:
 * - Use sessions and cookies
 * - Server remembers logged-in users
 * 
 * APIs (like our React frontend):
 * - Stateless (server doesn't remember users)
 * - Use tokens to identify users
 * - Token sent with each request
 * 
 * How Token Authentication Works:
 * 
 * 1. User logs in with email/password
 *    POST /api/login
 *    { email: "user@sound.com", password: "password123" }
 * 
 * 2. Server validates credentials
 *    - Check email exists
 *    - Verify password
 * 
 * 3. Server creates token
 *    - Generate random token string
 *    - Store in this table
 *    - Return to user
 * 
 * 4. User stores token (frontend)
 *    - Save in localStorage/sessionStorage
 *    - Include in all future requests
 * 
 * 5. User makes authenticated request
 *    GET /api/music
 *    Headers: { Authorization: "Bearer token_here" }
 * 
 * 6. Server validates token
 *    - Look up token in this table
 *    - Find associated user
 *    - Allow access
 * 
 * Fields Explained:
 * 
 * - id: Unique identifier for each token
 * 
 * - tokenable_type: Usually "App\Models\User"
 *   (which model owns this token)
 * 
 * - tokenable_id: The user's id
 *   (which user owns this token)
 * 
 * - name: Token identifier
 *   Example: "auth_token", "mobile_app", "web_browser"
 *   Useful if user has multiple devices
 * 
 * - token: The actual token string (hashed)
 *   Example: "1|abc123def456ghi789..."
 *   Format: id|random_hash
 *   IMPORTANT: Stored as hash for security
 * 
 * - abilities: Token permissions (JSON)
 *   Example: ["create-music", "delete-video"]
 *   Usually null (means full access)
 *   Advanced feature for fine-grained permissions
 * 
 * - last_used_at: Last API request with this token
 *   Example: "2024-01-15 10:30:00"
 *   Useful for:
 *   * Tracking inactive tokens
 *   * Security auditing
 *   * Auto-logout after inactivity
 * 
 * - expires_at: When token becomes invalid
 *   Example: "2024-02-15 10:30:00" (30 days later)
 *   Usually null (tokens don't expire)
 *   Can be set for temporary access
 * 
 * - created_at: When token was created (login time)
 * - updated_at: When token was last modified
 * 
 * Example Data:
 * 
 * personal_access_tokens table:
 * id | tokenable_type   | tokenable_id | name       | token              | last_used_at        | created_at
 * 1  | App\Models\User  | 5            | auth_token | 1|abc123...        | 2024-01-15 14:30:00 | 2024-01-15 10:00:00
 * 2  | App\Models\User  | 5            | mobile_app | 2|def456...        | 2024-01-15 12:00:00 | 2024-01-14 09:00:00
 * 3  | App\Models\User  | 8            | auth_token | 3|ghi789...        | 2024-01-15 15:00:00 | 2024-01-15 11:00:00
 * 
 * Understanding the data:
 * - Row 1: User #5's web browser token (last used at 14:30)
 * - Row 2: User #5's mobile app token (last used at 12:00)
 * - Row 3: User #8's web browser token (last used at 15:00)
 * 
 * Token Lifecycle:
 * 
 * 1. CREATE (Login):
 *    $token = $user->createToken('auth_token');
 *    Returns: "1|abc123def456..." (plain text)
 *    Stored: Hashed version in database
 * 
 * 2. USE (API Request):
 *    Frontend sends: Authorization: Bearer 1|abc123def456...
 *    Sanctum validates: Hash token, look up in table
 *    If found: Allow access, update last_used_at
 *    If not found: Return 401 Unauthorized
 * 
 * 3. DELETE (Logout):
 *    $request->user()->currentAccessToken()->delete();
 *    Removes token from table
 *    User must login again
 * 
 * Security Features:
 * 
 * 1. Token Hashing:
 *    - Actual token: "1|plainTextToken123"
 *    - Stored: SHA256 hash of "plainTextToken123"
 *    - Even if database leaked, attacker can't use tokens
 * 
 * 2. Token Uniqueness:
 *    - unique('token') prevents duplicates
 *    - Each token is cryptographically unique
 * 
 * 3. Last Used Tracking:
 *    - Detect suspicious activity
 *    - Auto-logout after X days of inactivity
 * 
 * 4. Token Expiration:
 *    - Optional expires_at field
 *    - Automatic cleanup of old tokens
 * 
 * Common Queries:
 * 
 * 1. "Get user from token"
 *    $user = $request->user(); // Sanctum does this automatically
 * 
 * 2. "Logout current device"
 *    $request->user()->currentAccessToken()->delete();
 * 
 * 3. "Logout all devices"
 *    $request->user()->tokens()->delete();
 * 
 * 4. "Get user's active tokens"
 *    $tokens = $user->tokens;
 * 
 * 5. "Check if token expired"
 *    if ($token->expires_at && $token->expires_at < now()) {
 *        // Token expired
 *    }
 * 
 * Laravel Usage:
 * 
 * // Login - Create token
 * $token = $user->createToken('auth_token')->plainTextToken;
 * 
 * // Return to frontend
 * return response()->json([
 *     'access_token' => $token,
 *     'token_type' => 'Bearer'
 * ]);
 * 
 * // Frontend stores and uses
 * localStorage.setItem('token', token);
 * 
 * // Frontend sends with requests
 * fetch('/api/music', {
 *     headers: {
 *         'Authorization': `Bearer ${token}`
 *     }
 * });
 * 
 * // Backend validates (automatic)
 * Route::middleware('auth:sanctum')->group(function() {
 *     Route::get('/music', ...);
 * });
 * 
 * // Logout - Delete token
 * $request->user()->currentAccessToken()->delete();
 * 
 * Business Rules:
 * 1. Token created on login
 * 2. Token sent with every API request
 * 3. Token validated by Sanctum middleware
 * 4. Token deleted on logout
 * 5. User can have multiple tokens (multiple devices)
 * 6. Tokens can be revoked individually or all at once
 * 7. Optional: Tokens can expire after X days
 * 8. Optional: Tokens can have specific permissions
 * 
 * This table is the CORE of API authentication!
 * Without it, your React frontend can't securely communicate with Laravel.
 */