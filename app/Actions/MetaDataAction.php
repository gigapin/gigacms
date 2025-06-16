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

use App\Models\Metadata;
use Exception;
use Src\Http\Request;

/**
 * 
 * @package GiGaCMS\MetaData
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 */
class MetaDataAction
{
  /**
   * @access protected
   * @var object
   */
  protected object $metadata;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->metadata = new Metadata('metadata');
  }

  /**
   * Storing metadata.
   *
   * @param object $postId
   * @return void
   * @throws Exception
   */
  public function insertMetaData(object $postId): void
  {
    $this->getMetadata($postId);
  }

  /**
   * Update metadata if has been created previously or insert if not.
   *
   * @param object $postId
   * @return void
   * @throws Exception
   */
  public function updateMetaData(object $postId): void
  {
    if ($this->metadata->findWhere('post_id', $postId->id)) {
      $this->metadata->updateWhere('post_id', $postId->id, [
        'meta_description' => Request::post('meta_description') !== "" ? trim(Request::post('meta_description')) : null,
        'keywords' => Request::post('keywords') !== '' ? trim(Request::post('keywords')) : null,
        'robots' => Request::post('robots') !== '' ? Request::post('robots') : null,
        'author' => Request::post('author') !== '' ? trim(Request::post('author')) : null,
        'post_id' => $postId->id, 
      ]);
    } else {
      $this->getMetadata($postId);
    }
  }

  /**
   * Get metadata values in post where is matched $postId argument.
   *
   * @param integer $postId
   * @return mixed
   * @throws Exception
   */
  public function getMetadataWhere(int $postId): mixed
  {
    $metadata = $this->metadata->findWhere('post_id', $postId);

    if (! $metadata) {
      return null;
    }

    return $metadata;
  }

  /**
   * @param object $postId
   * @return void
   * @throws Exception
   */
  public function getMetadata(object $postId): void
  {
    $this->metadata->insert([
      'meta_description' =>
        Request::post('meta_description') !== ""
          ? trim(Request::post('meta_description'))
          : null,
      'keywords' =>
        Request::post('keywords') !== ''
          ? trim(Request::post('keywords'))
          : null,
      'robots' =>
        Request::post('robots') !== ''
          ? Request::post('robots')
          : null,
      'author' =>
        Request::post('author') !== ''
          ? trim(Request::post('author'))
          : null,
      'post_id' => $postId->id,
    ]);
  }
}