const mongoose = require('mongoose');

const userSchema = new mongoose.Schema({
  username: { type: String, required: true },
  email: { type: String, required: true, unique: true },
  password: { type: String, required: true },
  role: { type: String, default: 'user' },  // Default role: user
  profilePicture: { type: String }, 
  reviews: [
    {
      movieId: { type: mongoose.Schema.Types.ObjectId, ref: 'Movie' },
      comment: String,
      rating: { type: Number, min: 1, max: 5 }
    }
  ]
}, { timestamps: true });

module.exports = mongoose.model('User', userSchema);
