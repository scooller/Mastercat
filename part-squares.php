<article class="square prefooter-nav">
    <div class="container-fluid">
        <div class="row flex-wrap flex-md-wrap flex-lg-nowrap">
        <?php
        if( have_rows('menu_big','option') ):
            $n=0;
            while( have_rows('menu_big','option') ) : the_row();
                $link=do_shortcode(get_sub_field('link'));
                $n++;
        ?>
            <<?php echo empty($link)?'div':'a href="'.$link.'"' ?> class="col-12 col-md-4 col-lg square__shape square-color<?=$n;?>">
                <?php echo do_shortcode(get_sub_field('contenido', false, false)); ?>
            </<?php echo empty($link)?'div':'a' ?>>
        <?php
            endwhile;
        endif;
        ?>        
        </div>
    </div>
</article>