    </div> <!-- content container -->
    <footer>
        <div class="container">
            <nav class="social-links">
                <ul>
                    <?php if (!empty(get_option('sowp_facebook'))): ?>
                    <li><a class="facebook" href="#" title="Facebook"></a></li>
                    <?php endif; ?>
                    <li><a class="vk" href="#" title="VK"></a></li>
                    <li><a class="instagram" href="#" title="Instagram"></a></li>
                    <li><a class="googleplus" href="#" title="Google Plus"></a></li>
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
