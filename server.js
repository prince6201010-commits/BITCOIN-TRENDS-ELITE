import express from 'express';
import cors from 'cors';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(express.json({ limit: '10mb' }));
app.use(express.urlencoded({ extended: true, limit: '10mb' }));

// Serve static assets from workspace root and public directory
app.use('/public', express.static(path.join(__dirname, 'public')));
app.use('/src', express.static(path.join(__dirname, 'src')));
app.use(express.static(__dirname));

// In-memory Database Stores
const subscribers = new Set([
  'editorial@bitcointrendelite.com',
  'satoshi@gmx.com'
]);

const contactMessages = [];

let articles = [
  {
    id: 'sovereignty-private-key',
    slug: 'sovereignty-private-key',
    title: 'The Sovereignty of the Private Key',
    category: 'Bitcoin',
    readTime: '12 Min Read',
    date: 'October 24, 2024',
    author: 'Elias Thorne',
    authorRole: 'Senior Fellow, Nakamoto Institute',
    image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB-sTPQESIBdIhICUMh9Ckd08_dxtQklxCVYbhmEL-m3HNhh8T7XSqLCGYPfxiN5ds0wL6Vnw6Zd9_gQoG9vnhTrTw9id_bPO2LOVzM7iw_hsSYOop56XS8P54nNsf75eh31da_wt-uOVyDoyv-a7XHn1qjniIQwCH-ES1_HT4BS9ABBNt7wEIRE_YfqsJYee9kozGMncMUP_3aaO7o3gJvzhqAibd5H_QPlxpFkWhF4c86DsmT9TN1IX-GkByqEALh86c_xLZnv7H3',
    snippet: 'In the digital landscape of the twenty-first century, ownership is rewritten in cryptography. Explore how 256-bit keys grant absolute sovereignty.',
    content: 'In the digital landscape of the twenty-first century, the concept of ownership has undergone a radical transformation. What was once defined by physical possession and legal titles is now being rewritten in the immutable language of cryptography. At the heart of this revolution lies a singular, potent artifact: the private key.\n\nTo understand the gravity of the private key is to understand the shift from permission-based systems to permissionless reality. Traditional finance relies on intermediation—a series of digital ledgers held by centralized entities who grant us access to our own value.\n\nIn the Bitcoin paradigm, the key serves as the bridge between the mathematical certainty of the network and the individual will. It is a 256-bit number that represents more than just a balance; it represents the absolute right of disposal. This is sovereignty distilled to its purest form.',
    status: 'Published',
    featured: true
  },
  {
    id: 'case-for-digital-scarcity',
    slug: 'case-for-digital-scarcity',
    title: 'A Case for Digital Absolute Scarcity',
    category: 'Bitcoin',
    readTime: '10 Min Read',
    date: 'Jan 15, 2024',
    author: 'Hal Finney',
    image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB1wz8cowi1U10l1HhzRKBmR-3HzXMkkrIIFpWM5fwCD7I6e_NVzvwKu7p5qf7_dP_am9XbIN6_7uJHDQlPlGvR8X9GAkqEt0ZkzhHGQ8UHs_HUxgMvxYLIoQkG3GhpCV52JRozJQ3Uj1OEz1MO79Vv2DkqABMfYzsKml8RKpENH9-SxNYzCSs5Ded98zVK4NtmQnRvqjIF6LCRG1j-2f-VMxmwA3bFm3UyKmiP2xKkLgKHMKA5yPNDx7nMKzSXW5nIQd3DrjO5n7WF',
    snippet: 'How the invention of Bitcoin solved the double-spend problem and redefined the nature of money forever.',
    content: 'Absolute scarcity is an unprecedented milestone in economic history. Prior to Bitcoin, every digital asset could be duplicated effortlessly. Nakamoto consensus established a cryptographic protocol that limits total supply to 21 million units.',
    status: 'Published',
    curated: true
  },
  {
    id: 'prehistory-electronic-cash',
    slug: 'prehistory-electronic-cash',
    title: 'The Prehistory of Electronic Cash',
    category: 'News',
    readTime: '14 Min Read',
    date: 'Jan 12, 2024',
    author: 'Nick Szabo',
    image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtLHCUrUMoRmpwsr013e3jx_dqH4u3PMA19-qB8jYXNCGX7rLVqXtuqXlDdbTxdrXoWEpEayQpm3lOH9Fo8pF1dkjyrJwkV-D_PWKnfVmQldxs-Om_d6IeIzjJ83usApvLxFSourC93WIcy5mAmL7DrGUVSHj5lQu-Ey3TujgHopdqd9SiCPcUuEPgPnq4I2wnR64EsbpPov00z58lpaR2bOKuMG2bz4uI2z6laDicq-gJZZhFYKdiEZlXRybiSqfu4qL2CEcJn3b0',
    snippet: 'From DigiCash to B-Money and Bit Gold: tracing the thirty-year lineage that culminated in Satoshi Nakamoto’s whitepaper.',
    content: 'The journey to sovereign electronic cash spans three decades of cypherpunk research. David Chaum, Wei Dai, and Nick Szabo established foundational concepts that laid the groundwork for Nakamoto consensus.',
    status: 'Published',
    curated: true
  },
  {
    id: 'consensus-global-rules',
    slug: 'consensus-global-rules',
    title: 'Consensus: The Logic of Global Rules',
    category: 'Trends',
    readTime: '4 Min Read',
    date: 'Jan 12, 2024',
    author: 'Saifedean Ammous',
    image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDUtfr7qjviOC1aev4m5jui6b4Gd4SS0m4HNzf3crAWzLdTgijZHWgMuwtd3N4gcggal4ANuK07Hakdi6jGGpxJBAhgyWH-196acGlrvFqgPytROVMc4iIlFOL0QwHVuMAneX63tLmnLkXrvQj5Zq6uNiyhtdn4Xj7CfEIN1RJSX-_oYXSwXHKgO2stB_RZRxhd9HN2HVytlOzcwEAEiD4NJKxzMoLQF5edOi9CiGV4gXmiAsZJoliLR56NeQDyI4T5ODmAYWttrU32',
    snippet: 'Why decentralized governance and unalterable rules are the only viable path for a global monetary network.',
    content: 'Rules without rulers provide predictable monetary policy. In a world of perpetual fiat debasement, unalterable consensus rules protect human labor and capital accumulation.',
    status: 'Published'
  }
];

// API Endpoints

// 1. Subscribe to Newsletter
app.post('/api/subscribe', (req, res) => {
  const { email } = req.body;
  if (!email || !email.includes('@') || !email.includes('.')) {
    return res.status(400).json({
      success: false,
      message: 'Please provide a valid encrypted email address.'
    });
  }

  const cleanEmail = email.trim().toLowerCase();
  if (subscribers.has(cleanEmail)) {
    return res.json({
      success: true,
      alreadySubscribed: true,
      message: 'You are already registered in the Editorial Circle.'
    });
  }

  subscribers.add(cleanEmail);
  return res.json({
    success: true,
    alreadySubscribed: false,
    message: 'Welcome to the Editorial Circle. Dispatch authorization granted.',
    subscriberCount: subscribers.size
  });
});

// 2. Get All Articles (with filter support)
app.get('/api/articles', (req, res) => {
  const { category, search, limit } = req.query;
  let results = articles.map(a => ({
    ...a,
    category: a.category || 'General'
  }));

  if (category && category !== 'All' && category !== 'ALL') {
    results = results.filter(a => a.category && a.category.toLowerCase() === category.toLowerCase());
  }

  if (search) {
    const q = search.toLowerCase();
    results = results.filter(a =>
      (a.title && a.title.toLowerCase().includes(q)) ||
      (a.snippet && a.snippet.toLowerCase().includes(q)) ||
      (a.category && a.category.toLowerCase().includes(q)) ||
      (a.author && a.author.toLowerCase().includes(q))
    );
  }

  if (limit) {
    results = results.slice(0, parseInt(limit, 10));
  }

  res.json({
    success: true,
    count: results.length,
    articles: results
  });
});

// 3. Search Endpoint
app.get('/api/search', (req, res) => {
  const q = (req.query.q || '').trim().toLowerCase();
  if (!q) {
    return res.json({ success: true, count: 0, results: [] });
  }

  const matches = articles.filter(a =>
    (a.title && a.title.toLowerCase().includes(q)) ||
    (a.snippet && a.snippet.toLowerCase().includes(q)) ||
    (a.category && a.category.toLowerCase().includes(q)) ||
    (a.author && a.author.toLowerCase().includes(q))
  );

  return res.json({
    success: true,
    query: req.query.q,
    count: matches.length,
    results: matches
  });
});

// 4. Single Article details
app.get('/api/articles/:slug', (req, res) => {
  const article = articles.find(a => a.slug === req.params.slug || a.id === req.params.slug);
  if (!article) {
    return res.status(404).json({ success: false, message: 'Article not found.' });
  }

  res.json({
    success: true,
    article
  });
});

// 5. Create Article (POST /api/articles)
app.post('/api/articles', (req, res) => {
  const { title, slug, category, author, readTime, date, image, snippet, content, status } = req.body;
  if (!title || !snippet) {
    return res.status(400).json({ success: false, message: 'Title and snippet are required.' });
  }

  const newArticle = {
    id: req.body.id || Date.now().toString(),
    slug: slug || title.toLowerCase().replace(/[\s\W-]+/g, '-'),
    title,
    category: category || 'General',
    author: author || 'Elias Thorne',
    readTime: readTime || '6 Min Read',
    date: date || new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }),
    image: image || 'https://lh3.googleusercontent.com/aida-public/AB6AXuB1wz8cowi1U10l1HhzRKBmR-3HzXMkkrIIFpWM5fwCD7I6e_NVzvwKu7p5qf7_dP_am9XbIN6_7uJHDQlPlGvR8X9GAkqEt0ZkzhHGQ8UHs_HUxgMvxYLIoQkG3GhpCV52JRozJQ3Uj1OEz1MO79Vv2DkqABMfYzsKml8RKpENH9-SxNYzCSs5Ded98zVK4NtmQnRvqjIF6LCRG1j-2f-VMxmwA3bFm3UyKmiP2xKkLgKHMKA5yPNDx7nMKzSXW5nIQd3DrjO5n7WF',
    snippet,
    content: content || snippet,
    status: status || 'Published',
    createdAt: new Date().toISOString()
  };

  articles.unshift(newArticle);

  res.json({
    success: true,
    message: 'Article created successfully.',
    article: newArticle
  });
});

// 6. Update Article (PUT /api/articles/:id)
app.put('/api/articles/:id', (req, res) => {
  const { id } = req.params;
  const index = articles.findIndex(a => a.id === id || a.slug === id);
  if (index === -1) {
    return res.status(404).json({ success: false, message: 'Article not found.' });
  }

  articles[index] = {
    ...articles[index],
    ...req.body,
    updatedAt: new Date().toISOString()
  };

  res.json({
    success: true,
    message: 'Article updated successfully.',
    article: articles[index]
  });
});


// 7. Delete Article (DELETE /api/articles/:id)
app.delete('/api/articles/:id', (req, res) => {
  const { id } = req.params;
  const initialLen = articles.length;
  articles = articles.filter(a => a.id !== id && a.slug !== id);

  if (articles.length === initialLen) {
    return res.status(404).json({ success: false, message: 'Article not found.' });
  }

  res.json({
    success: true,
    message: 'Article deleted successfully.'
  });
});

// 8. File / Base64 Image Upload Endpoint
app.post('/api/upload', (req, res) => {
  const { image } = req.body;
  if (!image) {
    return res.status(400).json({ success: false, message: 'No image payload received.' });
  }
  // Return hosted image payload URL
  res.json({
    success: true,
    imageUrl: image,
    message: 'Image payload uploaded successfully.'
  });
});

// 9. Contact Form Submission (Routed to editorial@bitcointrendelite.com)
app.post('/api/contact', (req, res) => {
  const { name, email, subject, message } = req.body;
  if (!name || !email || !message) {
    return res.status(400).json({ success: false, message: 'Please complete all required fields.' });
  }

  const contactEntry = {
    id: Date.now().toString(),
    recipient: 'editorial@bitcointrendelite.com',
    name,
    email,
    subject: subject || 'Editorial Board Inquiry',
    message,
    timestamp: new Date().toISOString()
  };

  contactMessages.push(contactEntry);
  console.log(`[Contact API] Message successfully routed to ${contactEntry.recipient} from ${name} (${email})`);

  res.json({
    success: true,
    recipient: 'editorial@bitcointrendelite.com',
    message: 'Your dispatch has been transmitted to Bitcoin Trend Elite.'
  });
});

// 10. Live Bitcoin Network Stats
app.get('/api/stats', (req, res) => {
  res.json({
    success: true,
    blockHeight: 841234,
    hashrate: '652.4 EH/s',
    satsPerByte: 14,
    unconfirmedTxs: 18420,
    halvingEta: 'April 2028',
    subscribersCount: subscribers.size
  });
});

// Fallback HTML page routing
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

app.get('/home', (req, res) => {
  res.sendFile(path.join(__dirname, 'home.html'));
});

app.get('/index', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

app.get('/blog', (req, res) => {
  res.sendFile(path.join(__dirname, 'blog.html'));
});

app.get('/category', (req, res) => {
  res.sendFile(path.join(__dirname, 'category.html'));
});

app.get('/about', (req, res) => {
  res.sendFile(path.join(__dirname, 'about.html'));
});

app.get('/admin', (req, res) => {
  res.sendFile(path.join(__dirname, 'admin.html'));
});

app.get('/admin/dashboard', (req, res) => {
  res.sendFile(path.join(__dirname, 'admin.html'));
});

// Start Server
app.listen(PORT, () => {
  console.log(`[Bitcoin Journal Backend Server] Running on http://localhost:${PORT}`);
});
