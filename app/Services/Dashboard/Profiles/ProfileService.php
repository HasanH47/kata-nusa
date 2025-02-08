<?php

namespace App\Services\Dashboard\Profiles;

use App\Models\Author;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
  public function update(array $data)
  {
    $user = Auth::user();
    $authorId = $user->author->id;

    $author = Author::findOrFail($authorId);

    $author->update([
      
    ])
  }
}
