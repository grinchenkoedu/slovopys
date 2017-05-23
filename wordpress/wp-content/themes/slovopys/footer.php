    </div> <!-- content container -->
    <footer>
        <div class="container">
            <nav class="social-links">
                <ul>
                    <?php if (!empty(get_option('sowp_facebook'))): ?>
                        <li><a class="facebook" href="<?php echo esc_attr(get_option('sowp_facebook')); ?>" title="Facebook" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if (!empty(get_option('sowp_youtube'))): ?>
                        <li><a class="vk" href="<?php echo esc_attr(get_option('sowp_youtube')); ?>" title="VK" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if (!empty(get_option('sowp_insta'))): ?>
                        <li><a class="instagram" href="<?php echo esc_attr(get_option('sowp_insta')); ?>" title="Instagram" target="_blank"></a></li>
                    <?php endif; ?>
                    <?php if (!empty(get_option('sowp_gplus'))): ?>
                        <li><a class="googleplus" href="<?php echo esc_attr(get_option('sowp_gplus')); ?>" title="Google Plus" target="_blank"></a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="copyright">
                <a href="http://astudia.kubg.edu.ua/">© Астудія</a>
            </div>
        </div>
    </footer>
    </body>
    <?php wp_footer(); ?>
</html>
