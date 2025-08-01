# Clean Magazine WordPress Theme

A minimal, magazine-style WordPress theme featuring a clean white design with a single post feed and tag filtering functionality.

## Features

- **Clean White Design**: Minimalist magazine-style layout with typography focus
- **Single Post Feed**: All posts displayed in a single, scrollable feed
- **Tag Filtering**: Filter posts by tags with an elegant tag bar at the top
- **Featured Images**: Optional post images displayed prominently
- **Responsive Design**: Mobile-friendly layout that adapts to all screen sizes
- **AJAX Tag Filtering**: Smooth tag filtering without page reloads
- **Post Navigation**: Previous/next post navigation on single post pages
- **Typography**: Beautiful serif fonts for a magazine-like reading experience

## Installation

1. Download or clone this theme to your WordPress `wp-content/themes/` directory
2. Rename the folder to `clean-magazine` if needed
3. Log in to your WordPress admin area
4. Go to **Appearance > Themes**
5. Find "Clean Magazine" and click **Activate**

## Setup

### Recommended Settings

1. **Reading Settings**: Go to **Settings > Reading** and set "Blog pages show at most" to 10-15 posts for optimal performance
2. **Permalink Settings**: Go to **Settings > Permalinks** and choose "Post name" for clean URLs
3. **Featured Images**: Set featured images for your posts to take advantage of the theme's visual design

### Required Content

For the best experience:
- Add **tags** to your posts to enable the filtering functionality
- Set **featured images** for posts to enhance visual appeal
- Use **excerpts** for better post previews (or the theme will auto-generate them)

## Theme Structure

```
clean-magazine-theme/
├── style.css              # Main stylesheet with theme header
├── index.php              # Main blog page template
├── single.php             # Individual post template
├── header.php             # Site header template
├── footer.php             # Site footer template
├── functions.php          # Theme functions and setup
├── js/
│   └── theme.js          # JavaScript for tag filtering
└── template-parts/
    └── post-item.php     # Reusable post item template
```

## Customization

### Colors
The theme uses a minimal color palette that can be easily customized in `style.css`:
- Background: `#fff` (white)
- Text: `#333` (dark gray)
- Accent: `#666` (medium gray)
- Borders: `#eee` (light gray)

### Typography
The theme uses Georgia serif font for a magazine-like appearance. You can change this in the `body` CSS rule in `style.css`.

### Layout
The theme is designed with a max-width of 1200px and can be adjusted in the `.container` CSS rule.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Contributing

This theme is designed to be minimal and focused. If you'd like to contribute:
1. Keep the design clean and minimal
2. Ensure mobile responsiveness
3. Test tag filtering functionality
4. Follow WordPress coding standards

## License

This theme is released under the GPL v2 or later license.