<?php

/*
 *   Template Name: Form Page
 *   Description: A Page Template for Forms
 *   Note: WordPress WYSISYG Breaks formatting
 *   Codex: http://codex.wordpress.org/Page_Templates#Custom_Page_Template
 *
 *   @package wp_arch
 *   @since wp_arch 1.0
 *
 */

get_header(); ?>

        <div class="primary" role="main">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

                <?php endwhile; // end of the loop. ?>

                <section class="form">
                    <form action="#" method="post">
                    <div><label for="name">Text Input:</label>
                    <input id="name" tabindex="1" type="text" name="name" value="" /></div>
                    <div>
                    <h4>Radio Button Choice</h4>
                    <label for="radio-choice-1">Choice 1</label>
                    <input id="radio-choice-1" tabindex="2" type="radio" name="radio-choice-1" value="choice-1" />

                    <label for="radio-choice-2">Choice 2</label>
                    <input id="radio-choice-2" tabindex="3" type="radio" name="radio-choice-2" value="choice-2" />

                    </div>
                    <div><label for="select-choice">Select Dropdown Choice:</label><select id="select-choice" name="select-choice"><option value="Choice 1">Choice 1</option><option value="Choice 2">Choice 2</option><option value="Choice 3">Choice 3</option></select></div>
                    <div><label for="textarea">Textarea:</label>
                    <textarea id="textarea" cols="40" name="textarea" rows="8"></textarea></div>
                    <div><label for="checkbox">Checkbox:</label>
                    <input id="checkbox" type="checkbox" name="checkbox" /></div>
                    <div><input type="submit" value="Submit" /></div>
                    </form>
                </section>

        </div><?php //.primary ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>