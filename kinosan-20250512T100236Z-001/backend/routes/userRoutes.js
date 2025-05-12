const express = require('express');
const router = express.Router();
const User = require('../models/User');
const { checkAuth } = require('../middleware/authMiddleware');

// Хэрэглэгчийн профайлыг авах
router.get('/profile', checkAuth, async (req, res) => {
  try {
    const user = await User.findById(req.user.id).select('-password'); // password-ыг нуух
    if (!user) return res.status(404).json({ msg: 'Хэрэглэгч олдсонгүй' });

    res.json({ user });
  } catch (err) {
    console.error(err.message);
    res.status(500).send('Серверийн алдаа');
  }
});

module.exports = router;
