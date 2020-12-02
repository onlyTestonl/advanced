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
            <div class="col-lg-4">
                <img src="/"/>
                <h2><?=$article->title?></h2>

                <p><?=$article->getShortText($article->text)?></p>

                <p><?=$article->data?></p>

                <p><?=$article->hits?></p>

                <p><a class="btn btn-default" href="<?=Url::to(['articles/article', 'id'=>$article->id] )?>"><?=$article->title?> &raquo;</a></p>
            </div>
            <? endforeach; ?>
        </div>


    </div>
</div>




