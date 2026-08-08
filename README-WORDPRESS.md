# Bitcoin Trend Elite — WordPress Theme & Migration Documentation

This repository contains the production-ready custom WordPress theme for **Bitcoin Trend Elite** along with migration utilities to convert the existing standalone website and custom admin panel into a self-hosted WordPress site.

---

## 1. Migration Overview

The project architecture has been converted from a custom static/Firebase/Node setup to a native WordPress CMS:

```
BEFORE:
Existing Website → Custom Admin Panel (admin.html) → Firebase/Firestore → Blog Posts

AFTER:
Existing Website UI → Custom WordPress Theme → WordPress Posts & Media → WordPress Database → WordPress Admin (/wp-admin)
```

- **Frontend UI/UX**: 100% preserved (Material dark aesthetic, Playfair Display & Space Grotesk fonts, glassmorphism, responsive navigation drawer, interactive search modal, subscribe modal, contact form, and 210-frame ultra-smooth canvas scroll engine).
- **Single Source of Truth**: Native WordPress Posts, Categories, and Media Library.
- **Admin System**: The custom admin panel (`admin.html`) and its hidden Express routes (`/html`, `/admin`, `/admin/dashboard`) are completely decommissioned. Administration takes place exclusively at `/wp-admin`.

---

## 2. Theme Structure

The theme files are located in `wordpress-theme/` and packaged as `wordpress-theme.zip`:

```
wordpress-theme/
├── style.css                 # Theme metadata and design system styles
├── functions.php             # Theme setup, asset enqueues, REST API endpoints
├── header.php                # Glassmorphic navigation header
├── footer.php                # 4-column footer, search & subscribe modals, mobile drawer
├── front-page.php            # Homepage with 210-frame scroll animation & WP queries
├── single.php                # Individual blog dispatch page
├── category.php              # Category archive & filtered dispatches
├── archive.php               # Generic archive template
├── index.php                 # Main index fallback
├── home.php                  # Blog posts index
├── page.php                  # Generic page template
├── page-about.php            # About & Manifesto page template
├── search.php                # Search results page
├── 404.php                   # 404 error page
├── template-parts/
│   ├── content.php           # Content fallback wrapper
│   ├── content-card.php      # Reusable blog card template
│   ├── content-single.php    # Single article view template
│   └── content-none.php      # Empty query message
└── assets/
    ├── css/
    │   └── style.css         # Utility CSS
    ├── js/
    │   ├── main.js           # 210-frame canvas scroll animation engine
    │   └── app.js            # UI modals, toasts, and REST search API connector
    ├── images/               # SVGs (logo.svg, logo-icon.svg)
    └── frames/               # 210 animation frame images (ezgif-frame-001.jpg to 210.jpg)
```

---

## 3. Installation & Theme Activation

1. Log in to your WordPress Dashboard (`/wp-admin`).
2. Navigate to **Appearance → Themes → Add New Theme**.
3. Click **Upload Theme** at the top of the page.
4. Select `wordpress-theme.zip` from your local computer and click **Install Now**.
5. Once installed, click **Activate**.

---

## 4. Content Migration (Importing Articles)

You can import all existing articles, categories, and images into WordPress using either of the following two methods:

### Option A: One-Click XML Import (Recommended)
1. Go to **WordPress Dashboard → Tools → Import**.
2. Click **Install Now** under **WordPress** (if not already installed), then click **Run Importer**.
3. Select `migration/bitcoin-journal-content.xml` from this repository and click **Upload file and import**.
4. Assign posts to an administrator user and click **Submit**.

### Option B: PHP / WP-CLI Import
If you have SSH / WP-CLI access to your server:
```bash
wp eval-file migration/import-to-wordpress.php
```

---

## 5. Client Blog Publishing Workflow

Publishing articles requires no coding or technical tools:

1. Open `https://your-domain.com/wp-admin` in any browser.
2. Enter your WordPress admin credentials.
3. Click **Posts → Add New Post**.
4. Enter the **Title** and write/paste your article **Content**.
5. Select or add a **Category** (e.g., *Bitcoin*, *News*, *Trends*) in the right sidebar.
6. Click **Set Featured Image** in the right sidebar to upload or select a cover image.
7. Click **Publish**.

The new article will immediately appear in the homepage dispatches, category archives, and instant search modal.

---

## 6. Category & Featured Image Management

- **Categories**: Managed natively in **Posts → Categories**. Initial categories (`Bitcoin`, `News`, `Trends`) are automatically created upon theme activation.
- **Featured Images**: Managed in the post editor via **Featured Image**. Featured images are automatically formatted to fit the theme's aspect ratios.

---

## 7. Component Audit: Decommissioned vs. Retained

### Decommissioned Components
- `admin.html`: Custom admin panel removed.
- `/html`, `/admin`, `/admin/dashboard`: Express routes removed.
- Firestore `blogs` and `categories` collections: Replaced by WordPress database.
- Firebase Auth for Admin: Replaced by WordPress User Authentication.

### Retained Components
- Material 3 dark design system, typography, glassmorphism, responsive navigation drawer, search modal, subscribe modal, and contact form.
- 210-frame ultra-smooth canvas scroll engine (`assets/js/main.js`).
- Auxiliary APIs in `server.js` (`/api/contact`, `/api/subscribe`, `/api/stats`) if running Node backend alongside WordPress.

---

## 8. Deployment & DNS Considerations

- Ensure PHP `memory_limit` is at least `128M` (recommended `256M`).
- Ensure PHP `upload_max_filesize` is at least `32M` to allow theme `.zip` upload.
- Permalinks: Go to **Settings → Permalinks** and select **Post name** (`/%postname%/`) for clean, SEO-friendly URLs.

---

## 9. Security Considerations

- Access to content administration is strictly controlled by WordPress role capabilities (`/wp-admin`).
- Public admin registration is disabled.
- Sensitive credentials (`.env`, passwords, API keys) are excluded via `.gitignore`.

---

## 10. Rollback Procedure

If you ever need to restore the pre-migration state:
1. Git revert or checkout commit `bd17c41` ("Pre-migration checkpoint").
2. Re-run `npm start` / `server.js`.
