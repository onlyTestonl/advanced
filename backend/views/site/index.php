<?php

use backend\models\Articles;
use backend\models\Picture;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

$model=new Articles;

$picture=new Picture;

?>
<?php $form = ActiveForm::begin([
    'id' => 'form-input-example',
    'options' => [
        'class' => 'form-horizontal col-lg-11',
        'enctype' => 'multipart/form-data',

    ],
]);?>
<?=$form->field($model, 'title')->textInput()->label('Заголовок статьи');?>

<?=$form->field($model, 'text')->label('Текст статьи')->widget(TinyMce::className(), [
    'options' => ['rows' => 7],
    'language' => 'ru',
    'clientOptions' => [
        'plugins' => [
            "searchreplace visualblocks fullscreen"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
]);?>
<?= $form->field($model, 'data')->label('Дата публикации')->textInput(['type' => 'date','format'=>'YYYY-mm-dd']); ?>

<?=$form->field($picture,'name')->label('Прикрепить изображение')->fileInput()?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Добавить статью'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end();?>