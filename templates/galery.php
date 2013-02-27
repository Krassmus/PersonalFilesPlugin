<style>
    #personal_files {
        padding: 0px;
    }
    #personal_files > li.file {
        margin: 7px;
        padding: 0px;
        background-color: rgba(35,35,35,1);
        border-radius: 17px;
        border: 5px solid lightgrey;
        color: white;
        width: 150px;
        height: 150px;
        overflow: hidden;
        text-align: center;
        display: inline-block;
        box-shadow: 0px 0px 10px rgba(150,150,150,0.2);
        transition-property: all;
        transition-duration: 0.3s;
    }
    #personal_files > li.file:hover {
        border: 5px solid grey;
        transition-property: all;
        transition-duration: 0.5s;
    }
    #personal_files > li.file > .icon {
        background-size: auto 100%;
        background-position: center top;
        background-repeat: no-repeat;
        background-color: #aaaaaa;
        width: 150px;
        height: 130px;
        margin-left: auto;
        margin-right: auto;
    }
    #personal_files > li.file > a.filename {
        color: white;
    }
    
</style>

<ul id="personal_files">
<? foreach ($files as $file) : 
?><li class="file">
    <? $mime_type = get_mime_type($file['filename']) ?>
    <? if (stripos($mime_type, "image") !== false) : ?> 
    <div class="icon" style="background-image: url('<?= GetDownloadLink($file['dokument_id'], $file['filename']) ?>');"></div>
    <? else : ?>
    <? $icon_path = GetFileIcon(substr($file['filename'], strripos($file['filename'], ".") + 1)) ?>
    <? $icon = substr($icon_path, strripos($icon_path, "/") + 1); ?>
    <div class="icon" style="background-image: url('<?= $assets."/130/blue/".$icon ?>');"></div>
    <? endif ?>
    <a class="filename" href="<?= GetDownloadLink($file['dokument_id'], $file['filename'], 0, 'force') ?>">
    <?= htmlReady($file['filename']) ?>
    </a>
</li><? endforeach ?>
</ul>