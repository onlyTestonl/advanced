<?php
use yii\helpers\Url;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Статьи</h1>

        <p class="lead">Здесь находится список ваших статей</p>
    </div>

    <div class="body-content">



        <div class="row">
            <? foreach($articles as $article):?>
            <?php
                foreach($pictures as $picture){
                    if ($picture->id==$article->picture_id) {
                        $path = '/backend/web/img/article_pics/' . $article->id . '/' . $picture->name;

                    }
                    else {
                        $path ='/backend/web/img/article_pics/1/264566.jpg';
                    }
                }

                ?>
            <div class="col-lg-4">
                <img src="<?= $path;?>" width="col-lg-4" height="200px"/>
                <h2><?=$article->title?></h2>

                <p><?=$article->getShortText($article->text)?></p>

                <p><?=$article->data?></p>

                <p><?=$article->hits?></p>

                <p><a class="btn btn-default" href="<?=Url::to(['articles/article', 'id'=>$article->id] )?>">Подробнее &raquo;</a></p>
            </div>
            <? endforeach; ?>
        </div>


    </div>
</div>




