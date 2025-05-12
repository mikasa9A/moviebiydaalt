const mongoose = require('mongoose');

const movieSchema = new mongoose.Schema({
  title: { type: String, required: true },
  description: String,
  trailerUrl: String,
  category: String,
  releaseDate: Date,
  posterUrl: String,
  videoUrl: String,
  addedBy: { type: mongoose.Schema.Types.ObjectId, ref: 'User' },
  reviews: [
    {
      user: { type: mongoose.Schema.Types.ObjectId, ref: 'User' },
      comment: String,
      rating: { type: Number, min: 1, max: 5 }
    }
  ]
}, { timestamps: true });

module.exports = mongoose.model('Movie', movieSchema);
