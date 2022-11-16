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

namespace App\Models;

use Src\QueryBuilder;

/** 
 * @package GiGaCMS\Comments
 * @author Giuseppe Galari <gigaprog@proton.me>
 * @version 1.0.0
 * @see QueryBuilder
 */
class Comment extends QueryBuilder
{
    /**
     * Display how many comments have been created for the specified post.
     *
     * @param integer $postId
     * @return int
     */
    public function countComments(int $postId): int
    {
        $comments = $this->findAllWhere('post_id', $postId);
        return count($comments);
    }
}