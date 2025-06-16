<?php 
/*
 * This file is part of the GiGaCMS package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace App\Actions;

use App\Models\Media;
use Exception;
use Random\RandomException;
use Src\Auth;
use Src\UploadFile;
use Src\Http\Request;

/**
 * 
 * @package GiGaCMS\Media
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class MediaAction
{
  use UploadFile;

  /**
   * @access private
   * @var object
   */
  private object $request, $media;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->request = new Request();
    $this->media = new Media('media');
  }
  
  /**
   * Get file from form.
   *
   * @param string $value
   * @return array
   */
  public function file(string $value): array 
  {
    return Request::file($value);
  }

  /**
   * Get all resources.
   *
   * @return array
   */
  public function getAll(): array
  {
    return $this->media->findAll();
  }

  /**
   * Get specific resource.
   *
   * @param string $field
   * @param integer $id
   * @return mixed
   * @throws Exception
   */
  public function getWhere(string $field, int $id): mixed
  {
    return $this->media->findWhere($field, $id);
  }

  /**
   * Set random string to replace image name.
   *
   * @return string
   * @throws RandomException
   */
  private function setImageName(): string
  {
    return random_bytes(40);
  }

  /**
   * Set path to upload image.
   *
   * @return string
   */
  public function getStoragePath(): string
  {
    $url = $this->request->site() . "uploads/";

    if ($_ENV['APP_ENV'] == 'development') {
      return "http://" . $url;
    } else {
      return "https://" . $url;
    }
  }

  /**
   * Storing file uploaded.
   *
   * @param integer $postId
   * @return void
   * @throws Exception
   */
  public function insertFile(int $postId): void
  {
    if ($this->file('featured')['name'] !== '') {
      $this->media->insert([
        'post_id' => $postId,
        'name' => $this->file('featured')['name'],
        'url' => $this->getStoragePath() . $this->file('featured')['full_path'],
        'created_by' => Auth::id(),
        'created_at' => setDate(),
        'updated_at' => setDate(),
      ]);

      $this->moveUploadedFile($this->file('featured'));
    }
  }

  /**
   * Update file uploaded.
   *
   * @param integer $postId
   * @return void
   * @throws Exception
   */
  public function updateFile(int $postId): void
  {
    if ($this->file('featured')['name'] !== '') {
      if ($this->media->findWhere('post_id', $postId) !== false) {
        $this->media->updateWhere('post_id', $postId, [
          'post_id' => $postId,
          'name' => $this->file('featured')['name'],
          'url' => $this->getStoragePath() . $this->file('featured')['full_path'],
          'created_by' => Auth::id(),
          'updated_at' => setDate(),
        ]);
      } else {
        $this->media->insert([
          'post_id' => $postId,
          'name' => $this->file('featured')['name'],
          'url' => $this->getStoragePath() . $this->file('featured')['full_path'],
          'created_by' => Auth::id(),
          'updated_at' => setDate(),
        ]);
      }

      $this->moveUploadedFile($this->file('featured'));
    }
  }
  
}