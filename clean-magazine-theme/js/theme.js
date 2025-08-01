jQuery(document).ready(function($) {
    // Tag filtering functionality
    $('.tag-link').on('click', function(e) {
        // Don't prevent default for "All Posts" link
        if ($(this).hasClass('clear-filter')) {
            return true;
        }
        
        e.preventDefault();
        
        var tagSlug = $(this).data('tag');
        var $postsContainer = $('#posts-container');
        
        // Update active states
        $('.tag-link').removeClass('active');
        $(this).addClass('active');
        
        // Show loading state
        $postsContainer.html('<div class="loading">Loading posts...</div>');
        
        // AJAX request
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_posts',
                tag: tagSlug,
                nonce: ajax_object.nonce
            },
            success: function(response) {
                $postsContainer.html(response);
                
                // Update URL without page refresh
                var newUrl = $(e.target).attr('href');
                if (newUrl) {
                    window.history.pushState(null, null, newUrl);
                }
            },
            error: function() {
                $postsContainer.html('<div class="error">Sorry, there was an error loading the posts.</div>');
            }
        });
    });
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(e) {
        location.reload();
    });
    
    // Smooth scrolling for read more links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        
        var target = this.hash;
        var $target = $(target);
        
        if ($target.length) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 20
            }, 800);
        }
    });
});

// Add loading styles
jQuery(document).ready(function($) {
    // Add CSS for loading and error states
    var styles = `
        <style>
        .loading, .error {
            text-align: center;
            padding: 40px 20px;
            font-style: italic;
            color: #666;
        }
        
        .error {
            color: #d32f2f;
        }
        
        .no-posts {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .no-posts h2 {
            margin-bottom: 15px;
            color: #333;
        }
        
        .single-post .post-content {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 40px;
        }
        
        .single-post .post-content p {
            margin-bottom: 20px;
        }
        
        .post-navigation {
            display: flex;
            justify-content: space-between;
            margin: 40px 0;
            padding: 20px 0;
            border-top: 1px solid #eee;
        }
        
        .post-navigation a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }
        
        .post-navigation a:hover {
            color: #666;
        }
        
        .back-to-blog {
            text-align: center;
            margin: 40px 0;
        }
        
        .tag-count {
            font-size: 0.8em;
            opacity: 0.7;
        }
        </style>
    `;
    
    $('head').append(styles);
});