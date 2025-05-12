const checkAdmin = (req, res, next) => {
  if (req.user.role !== 'admin') {
    return res.status(403).json({ msg: 'Админ эрх шаардлагатай.' });
  }
  next();
};

module.exports = checkAdmin;