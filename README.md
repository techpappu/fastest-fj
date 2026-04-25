# fastest_fj - WooCommerce Jewelry Theme

A premium, fully responsive WooCommerce theme designed specifically for jewelry stores. Built with Tailwind CSS and featuring an elegant gold/cream color palette.

## Features

- **Fully Responsive** - Mobile-first design with hamburger menu and touch-friendly interfaces
- **Complete WooCommerce Integration** - Shop, product, cart, checkout, and account templates
- **Custom Product Gallery** - Image thumbnails with click-to-switch functionality
- **AJAX Cart** - Add to cart without page refresh with live cart count updates
- **Wishlist System** - Built-in wishlist functionality for logged-in users
- **Customizable Hero Section** - WordPress Customizer support for homepage content
- **Multiple Page Templates** - About, Contact, and Wishlist page templates
- **Blog Support** - Full blog with categories, tags, and sidebar widgets
- **Payment Icons** - Visa, Mastercard, Amex, PayPal, Apple Pay
- **Social Media Links** - Customizer settings for Facebook, Instagram, Pinterest, Twitter, YouTube
- **SEO Friendly** - Semantic HTML structure and schema-ready

## Theme Structure

```
fastest_fj/
|-- 404.php                          # 404 error page
|-- archive.php                      # Blog archive template
|-- front-page.php                   # Homepage template
|-- footer.php                       # Footer template
|-- functions.php                    # Theme functions & setup
|-- header.php                       # Header template
|-- index.php                        # Main blog template
|-- page.php                         # Default page template
|-- sidebar.php                      # Blog sidebar
|-- single.php                       # Single blog post
|-- style.css                        # Main stylesheet
|-- woocommerce.php                  # Main WooCommerce wrapper
|-- template-about.php               # About page template
|-- template-contact.php             # Contact page template
|-- template-wishlist.php            # Wishlist page template
|-- assets/
|   |-- css/
|   |   |-- admin.css               # Admin styles
|   |-- js/
|   |   |-- main.js                 # Theme JavaScript
|   |   |-- woocommerce.js          # WooCommerce JS
|   |   |-- wishlist.js             # Wishlist JS
|-- inc/
|   |-- customizer.php              # WordPress Customizer settings
|   |-- template-functions.php      # Template helper functions
|-- woocommerce/
|   |-- archive-product.php         # Shop page template
|   |-- single-product.php          # Single product template
|   |-- content-product.php         # Product loop item
|   |-- cart/
|   |   |-- cart.php                # Cart page template
|   |-- checkout/
|   |   |-- form-checkout.php       # Checkout form
|   |   |-- review-order.php        # Order review sidebar
|   |-- myaccount/
|   |   |-- my-account.php          # Account dashboard
|   |   |-- navigation.php          # Account nav menu
|   |   |-- dashboard.php           # Dashboard content
```

## Installation

### 1. Install Theme

1. Download the theme as a `.zip` file
2. Go to **WordPress Admin > Appearance > Themes > Add New > Upload Theme**
3. Upload the `.zip` file and click **Activate**

### 2. Install WooCommerce

1. Go to **Plugins > Add New**
2. Search for "WooCommerce"
3. Install and activate the plugin
4. Run the WooCommerce setup wizard to configure your store

### 3. Required Pages

Create these pages with the corresponding templates:

| Page Title | Template | Description |
|-----------|----------|-------------|
| Shop | Default | Product listing (set as Shop page in WooCommerce > Settings > Products) |
| Cart | Default | Shopping cart (set as Cart page in WooCommerce > Settings > Advanced) |
| Checkout | Default | Checkout page (set as Checkout page in WooCommerce > Settings > Advanced) |
| My Account | Default | Customer account (set as My Account page in WooCommerce > Settings > Advanced) |
| About Us | About Page | Company info page |
| Contact | Contact Page | Contact form page |
| Wishlist | Wishlist Page | Saved items page |

### 4. Configure Menus

Go to **Appearance > Menus** and create these menus:

- **Primary Menu** - Main desktop navigation (assign to "Primary" location)
- **Mobile Menu** - Mobile navigation (assign to "Mobile" location)
- **Footer Columns 1-3** - Footer navigation links

### 5. Customize Theme

Go to **Appearance > Customize** to configure:

- **Hero Section** - Background image, title, subtitle, buttons
- **Our Promise** - 3 feature boxes with custom text
- **Contact Information** - Phone, email, address, business hours
- **Social Media** - Links to Facebook, Instagram, Pinterest, Twitter, YouTube

## WooCommerce Setup

### Product Categories

Create product categories in **Products > Categories**:
- Necklaces
- Earrings
- Rings
- Bracelets
- Nose Pins

Upload category thumbnails for homepage display.

### Product Attributes (Optional)

Create attributes for filtering:
- Material (Gold, Silver, Platinum, Rose Gold)
- Gemstone (Diamond, Ruby, Sapphire, Emerald, Pearl)

### Recommended Settings

In **WooCommerce > Settings**:
- **General**: Set store address, currency, dimensions
- **Products > Inventory**: Enable stock management
- **Shipping**: Add shipping zones and methods
- **Accounts & Privacy**: Configure account creation and guest checkout

## Shortcodes Support

The Contact page template supports:
- **Contact Form 7** - `[contact-form-7 title="Contact form 1"]`
- **WPForms** - `[wpforms id="1"]`

The footer newsletter section supports:
- **MailChimp for WordPress** - `[mc4wp_form]`

## Customization Tips

### Change Brand Colors

Edit `style.css` and search for these colors:
- `#C9A961` - Gold (primary brand color)
- `#E8913A` - Orange (accent/hover color)
- `#FAF8F4` - Cream (background color)
- `#1E1E1E` - Dark (footer/headers)

### Add Custom CSS

Go to **Appearance > Customize > Additional CSS** for custom styling.

### Widget Areas

Three widget areas are registered:
- **Shop Sidebar** - Appears on shop/category pages
- **Blog Sidebar** - Appears on blog posts/archive
- **Footer Top** - Appears above footer columns

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Safari iOS (latest)
- Chrome Android (latest)

## License

GPL v2 or later

## Credits

- Tailwind CSS - https://tailwindcss.com
- Font Awesome - https://fontawesome.com
- Google Fonts (Playfair Display, Lato) - https://fonts.google.com
- Unsplash images (demo) - https://unsplash.com
