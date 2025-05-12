const jwt = require('jsonwebtoken');
const User = require('../models/User');

const checkAdmin = (req, res, next) => {
  if (req.user.role !== 'admin') {
    return res.status(403).json({ msg: 'Admin access required' });
  }
  next();
};

const authMiddleware = async (req, res, next) => {
  const authHeader = req.headers.authorization;
  if (!authHeader?.startsWith('Bearer ')) return res.status(401).json({ msg: 'Token required' });

  const token = authHeader.split(' ')[1];

  try {
    const decoded = jwt.verify(token, 'secret123'); // JWT_SECRET ашиглах
    req.user = await User.findById(decoded.id).select('-password');
    if (!req.user) return res.status(401).json({ msg: 'User not found' });
    next();
  } catch (err) {
    res.status(401).json({ msg: 'Invalid token' });
  }
};

module.exports = { authMiddleware, checkAdmin };
