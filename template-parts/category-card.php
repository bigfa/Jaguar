<?php
global $jaguarSetting;
$categories = get_the_category();
?>
<?php if (!empty($categories)) : ?>
    <div class="poppyCategory--card__list">
        <?php
        foreach ($categories as  $category) {
            echo '<a href="' . get_category_link($category->term_id) . '" class="poppyCategory--card">';
            if (get_term_meta($category->term_id, '_thumb', true)) {
                echo '<div class="poppyCategory--card__image">';
                echo '<img src="' . get_term_meta($category->term_id, '_thumb', true) . '" alt="' . $category->name . '"/>';
                echo '</div>';
            }
            echo '<div class="poppyCategory--card__content">';
            echo '<div class="poppyCategory--card__title">' . $category->name . '</div>';
            echo '<div class="poppyCategory--card__description">' . $category->description . '</div>';
            echo '</div></a>';
        }
        ?>
    </div>
<?php endif; ?>