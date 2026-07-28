import { initializeApp, getApps, getApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { 
  getFirestore, 
  collection, 
  doc, 
  getDoc, 
  onSnapshot, 
  query, 
  where, 
  orderBy 
} from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDUGko63WKzWA0EoHvc1rH8rOcpdk3wlnE",
  authDomain: "bitcoin-trend-elite.firebaseapp.com",
  projectId: "bitcoin-trend-elite",
  storageBucket: "bitcoin-trend-elite.firebasestorage.app",
  messagingSenderId: "570680934709",
  appId: "1:570680934709:web:cd4340e434a146a3cd0c7c"
};

// Initialize Firebase safely (Singleton)
const app = getApps().length === 0 ? initializeApp(firebaseConfig) : getApp();
const db = getFirestore(app);

const PUBLIC_DEFAULT_CATEGORIES = [
  { id: 'bitcoin', name: 'Bitcoin', slug: 'bitcoin', displayOrder: 1, isVisible: true },
  { id: 'news', name: 'News', slug: 'news', displayOrder: 2, isVisible: true },
  { id: 'trends', name: 'Trends', slug: 'trends', displayOrder: 3, isVisible: true }
];

/**
 * Real-time Listener for Published Blogs on Home Page
 */
export function initHomeBlogsListener(onBlogsUpdated) {
  const blogsRef = collection(db, "blogs");
  const q = query(blogsRef, orderBy("createdAt", "desc"));

  return onSnapshot(q, (snapshot) => {
    const publishedBlogs = [];
    snapshot.forEach((docSnap) => {
      const data = docSnap.data();
      if (data.status === 'Published' || !data.status) {
        publishedBlogs.push({ id: docSnap.id, ...data });
      }
    });
    onBlogsUpdated(publishedBlogs);
  }, (error) => {
    console.warn("Firestore public blogs listener warning:", error);
  });
}

/**
 * Fetch a single blog by Slug or Document ID for Single Article Page
 */
export function initSingleBlogListener(slugOrId, onBlogLoaded) {
  if (!slugOrId) return;

  const blogsRef = collection(db, "blogs");
  const q = query(blogsRef, where("slug", "==", slugOrId));
  
  const unsub = onSnapshot(q, async (snapshot) => {
    if (!snapshot.empty) {
      const docSnap = snapshot.docs[0];
      onBlogLoaded({ id: docSnap.id, ...docSnap.data() });
    } else {
      try {
        const docRef = doc(db, "blogs", slugOrId);
        const directSnap = await getDoc(docRef);
        if (directSnap.exists()) {
          onBlogLoaded({ id: directSnap.id, ...directSnap.data() });
        } else {
          onBlogLoaded(null);
        }
      } catch (err) {
        onBlogLoaded(null);
      }
    }
  }, (error) => {
    console.error("Error fetching article by slug:", error);
    onBlogLoaded(null);
  });

  return unsub;
}

/**
 * Real-time listener for visible categories, ordered by displayOrder.
 * Used on all public pages to dynamically render category pills/navigation.
 * Includes automatic client-side sorting and default fallbacks.
 * @param {function} onCategoriesUpdated - callback receives array of category objects
 * @returns {function} unsubscribe function
 */
export function initCategoriesListener(onCategoriesUpdated) {
  const categoriesRef = collection(db, "categories");

  return onSnapshot(categoriesRef, (snapshot) => {
    if (snapshot.empty) {
      onCategoriesUpdated(PUBLIC_DEFAULT_CATEGORIES);
      return;
    }

    const categories = [];
    snapshot.forEach((docSnap) => {
      const data = docSnap.data();
      if (data.isVisible !== false) {
        categories.push({ id: docSnap.id, ...data });
      }
    });

    categories.sort((a, b) => (a.displayOrder ?? 99) - (b.displayOrder ?? 99));

    if (categories.length === 0) {
      onCategoriesUpdated(PUBLIC_DEFAULT_CATEGORIES);
    } else {
      onCategoriesUpdated(categories);
    }
  }, (error) => {
    console.warn("Firestore categories listener warning:", error);
    onCategoriesUpdated(PUBLIC_DEFAULT_CATEGORIES);
  });
}

/**
 * Real-time listener for published blogs filtered by categoryId.
 * Also handles legacy blogs that stored a plain `category` string.
 * @param {string} categoryId - Firestore document ID of the category
 * @param {string} categoryName - Name of the category (for legacy fallback matching)
 * @param {function} onBlogsUpdated - callback receives filtered blogs array
 * @returns {function} unsubscribe function
 */
export function initBlogsByCategoryListener(categoryId, categoryName, onBlogsUpdated) {
  const blogsRef = collection(db, "blogs");
  const q = query(blogsRef, orderBy("createdAt", "desc"));

  return onSnapshot(q, (snapshot) => {
    const filtered = [];
    snapshot.forEach((docSnap) => {
      const data = docSnap.data();
      if (data.status !== 'Published' && data.status) return; // skip drafts
      const matchesId = data.categoryId === categoryId;
      const matchesLegacy = !data.categoryId && data.category &&
        data.category.toLowerCase() === (categoryName || '').toLowerCase();
      if (matchesId || matchesLegacy) {
        filtered.push({ id: docSnap.id, ...data });
      }
    });
    onBlogsUpdated(filtered);
  }, (error) => {
    console.warn("Firestore blogs-by-category listener warning:", error);
    onBlogsUpdated([]);
  });
}
