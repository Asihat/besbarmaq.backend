<?php

namespace App\Functional\Lenta;

use App\Functional\Lenta\Services\AddComment;
use App\Functional\Lenta\Services\Comments;
use App\Functional\Lenta\Services\Index;
use App\Functional\Lenta\Services\Information;

class Lenta implements ILenta
{
    use Index, Information, Comments, AddComment;
}
