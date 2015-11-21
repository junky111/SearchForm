<?php

?>
<div class = "j-form">
<form method="POST">
    <fieldset>
        <div class = "j-country" >
            <label><?php echo $name ?>
                <?php dd_list($name, $options, array(''     =>   'Please Select')); ?>
            </label>
        </div>
        <div class = "j-city" >
            <label>City
                <?php dd_list(null, null, array(''     =>   'Please Select')); ?>
            </label>
        </div>
        <div class = "j-library" >
            <label>Library
                <?php dd_list(null, null, array(''     =>   'Please Select')); ?>
            </label>
        </div>
    </fieldset>
    <div class = "j-book">
            <div>
                <label>Genre
                    <?php dd_list(null, null, array(''     =>   'Please Select')); ?>
                </label>
            </div>
            <div>
                <label>
                    <input type="text" name="remember">Author
                </label>
            </div>
            <div>
                <label>
                    <input type="text" name="remember">Book
                </label>
            </div>
            <div>
                <label>
                    <input class="btn" type="submit" name="submit" value="Search">
                </label>
            </div>
    </div>

</form>
</div>
<script  type="text/javascript">
    searchForm.init();
</script>