<?php
/**
 * Template Name: Contact Page
 * Template for the contact page with address and form
 *
 * @package zuidakker-child
 */

namespace Kadence;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

kadence()->print_styles( 'kadence-content' );
?>

<div id="primary" class="content-area">
    <div class="content-container site-container">
        <main id="main" class="site-main">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>

                    <div class="entry-content">
                        
                        <!-- Contact Information Section -->
                        <div class="contact-info-section">
                            <div class="contact-info-grid">
                                
                                <!-- Address Card with Map -->
                                <div class="contact-card contact-card-map">
                                    <div class="contact-card-icon">📍</div>
                                    <h3>Bezoekadres</h3>
                                    <p>
                                        <strong>Zuidakker</strong><br>
                                        Zuideinde 112 e<br>
                                        2371BZ Roelofarendsveen<br>
                                        Nederland
                                    </p>
                                    <?php zuidakker_display_contact_map(); ?>
                                </div>

                                <!-- Email Card -->
                                <div class="contact-card">
                                    <div class="contact-card-icon">✉️</div>
                                    <h3>Email</h3>
                                    <p>
                                        <a href="mailto:info@zuidakker.nl">info@zuidakker.nl</a>
                                    </p>
                                </div>

                                <!-- Opening Hours Card -->
                                <div class="contact-card">
                                    <div class="contact-card-icon">🕐</div>
                                    <h3>Openingstijden</h3>
                                    <p>
                                        Ma - Vr: Op afspraak<br>
                                        Za: Gesloten<br>
                                        Zo: Gesloten
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Contact Form Section -->
                        <div class="contact-form-section">
                            <h2>Stuur ons een bericht</h2>
                            <p>Heeft u een vraag of opmerking? Vul het onderstaande formulier in en wij nemen zo spoedig mogelijk contact met u op.</p>
                            
                            <?php
                            // You can replace this with a WordPress form plugin shortcode
                            // Examples: Contact Form 7, WPForms, Gravity Forms
                            // For now, we'll use a basic HTML form
                            ?>
                            
                            <form class="contact-form" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
                                <input type="hidden" name="action" value="zuidakker_contact_form">
                                <?php wp_nonce_field( 'zuidakker_contact_form', 'contact_nonce' ); ?>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="contact_name">Naam *</label>
                                        <input type="text" id="contact_name" name="contact_name" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="contact_email">Email *</label>
                                        <input type="email" id="contact_email" name="contact_email" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact_phone">Telefoon</label>
                                    <input type="tel" id="contact_phone" name="contact_phone">
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact_subject">Onderwerp *</label>
                                    <input type="text" id="contact_subject" name="contact_subject" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact_message">Bericht *</label>
                                    <textarea id="contact_message" name="contact_message" rows="6" required></textarea>
                                </div>
                                
                                <button type="submit" class="contact-submit-btn">
                                    <span>Verstuur bericht</span>
                                    <span class="btn-icon">→</span>
                                </button>
                            </form>
                            
                            <!-- Alternative: Use Contact Form 7 shortcode -->
                            <!-- <?php // echo do_shortcode('[contact-form-7 id="123" title="Contact form"]'); ?> -->
                            
                        </div>

                        <?php
                        // Display page content if any
                        the_content();
                        ?>

                    </div>

                </article>
                <?php
            endwhile;
            ?>
        </main>
    </div>
</div>

<?php
get_footer();
