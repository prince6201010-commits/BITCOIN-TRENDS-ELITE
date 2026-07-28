# ₿ Bitcoin Trends Elite

A premium Bitcoin journalism platform — featuring editorial articles, live stats, an admin dashboard, and a Firebase-powered backend.

## 🔗 Live Deployments

- **Render (Backend API + Frontend):** Deployed via `render.yaml`
- **Firebase Hosting:** Deployed via `firebase.json`

---

## 🚀 Tech Stack

| Layer | Technology |
|---|---|
| Frontend | Vanilla HTML, CSS, JS |
| Backend | Node.js + Express |
| Database | Firestore (Firebase) |
| Hosting | Firebase Hosting + Render |

---

## 📁 Project Structure

```
├── index.html          # Landing / Home page
├── home.html           # Home page alternate
├── blog.html           # Blog listing
├── category.html       # Category filtered view
├── about.html          # About page
├── admin.html          # Admin dashboard
├── server.js           # Express backend server
├── src/
│   ├── app.js          # Main frontend JS
│   ├── firebase-public.js  # Firebase Firestore client
│   ├── main.js         # Entry point
│   ├── style.css       # Global styles
│   └── constants.js    # Shared constants
├── firebase.json       # Firebase project config
├── firestore.rules     # Firestore security rules
├── storage.rules       # Firebase Storage rules
├── render.yaml         # Render deployment config
└── package.json        # Node dependencies
```

---

## ⚙️ Local Development

```bash
# Install dependencies
npm install

# Run Express backend server
npm start            # → http://localhost:3000

# Or run Vite dev server (frontend only)
npm run dev          # → http://localhost:5173
```

---

## 🌐 Deploy to Render

1. Connect this GitHub repo on [render.com](https://render.com)
2. Render will auto-detect `render.yaml`
3. Set the `PORT` env var to `3000` (already in render.yaml)
4. Click **Deploy**

---

## 🔥 Deploy to Firebase Hosting

```bash
# Install Firebase CLI globally
npm install -g firebase-tools

# Login
firebase login

# Deploy hosting + Firestore rules
firebase deploy
```

---

## 🔑 Firebase Configuration

Firebase config is embedded in `src/firebase-public.js` (public read-only keys — safe for frontend use).

Project ID: `bitcoin-trend-elite`

---

## 📡 API Endpoints (Express)

| Method | Route | Description |
|---|---|---|
| `GET` | `/api/articles` | Fetch all articles (filter by `?category=`, `?search=`) |
| `GET` | `/api/articles/:slug` | Single article by slug |
| `POST` | `/api/articles` | Create new article |
| `PUT` | `/api/articles/:id` | Update article |
| `DELETE` | `/api/articles/:id` | Delete article |
| `POST` | `/api/subscribe` | Newsletter subscribe |
| `POST` | `/api/contact` | Contact form submission |
| `GET` | `/api/stats` | Live Bitcoin network stats |
| `GET` | `/api/search` | Search articles |

---

*Built with ❤️ for the Bitcoin community.*
# BITCOIN-TRENDS-ELITE
"# BITCOIN-TRENDS-ELITE" 
"# BITCOIN-TRENDS-ELITE" 
"# BITCOIN-TRENDS-ELITE" 
