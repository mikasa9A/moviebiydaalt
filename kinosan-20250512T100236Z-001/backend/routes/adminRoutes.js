const express = require('express');
const Movie = require('../models/Movie');
const router = express.Router();
const { authMiddleware, checkAdmin } = require('../middleware/authMiddleware'); // Админ шалгах middleware

// Кино нэмэх
router.post('/', authMiddleware, checkAdmin, async (req, res) => { // authMiddleware ба checkAdmin ашиглах
  try {
    const movie = new Movie({
      title: req.body.title,
      description: req.body.description,
      trailerUrl: req.body.trailerUrl,
      category: req.body.category,
      releaseDate: req.body.releaseDate,
      posterUrl: req.body.posterUrl,
      addedBy: req.body.addedBy, 
    });

    const savedMovie = await movie.save();
    res.status(201).json(savedMovie);
  } catch (error) {
    res.status(500).json({ message: 'Error adding movie', error });
  }
});

// Киноны жагсаалт авах
router.get('/', async (req, res) => {
  try {
    const movies = await Movie.find();
    res.status(200).json(movies);
  } catch (error) {
    res.status(500).json({ message: 'Error fetching movies', error });
  }
});

// Кино засах
router.put('/:id', authMiddleware, checkAdmin, async (req, res) => { // authMiddleware ба checkAdmin ашиглах
  try {
    const updatedMovie = await Movie.findByIdAndUpdate(req.params.id, req.body, { new: true });
    res.status(200).json(updatedMovie);
  } catch (error) {
    res.status(500).json({ message: 'Error updating movie', error });
  }
});

// Кино устгах
router.delete('/:id', authMiddleware, checkAdmin, async (req, res) => { // authMiddleware ба checkAdmin ашиглах
  try {
    await Movie.findByIdAndDelete(req.params.id);
    res.status(200).json({ message: 'Movie deleted successfully' });
  } catch (error) {
    res.status(500).json({ message: 'Error deleting movie', error });
  }
});

module.exports = router;
