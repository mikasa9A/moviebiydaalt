const Movie = require('../models/Movie');

exports.addMovie = async (req, res) => {
  try {
    const movie = new Movie({
      title: req.body.title,
      description: req.body.description,
      trailerUrl: req.body.trailerUrl,
      category: req.body.category,
      releaseDate: req.body.releaseDate,
      posterUrl: req.body.posterUrl,
      addedBy: req.user.id,  // Кино нэмсэн хэрэглэгчийн ID
    });

    const savedMovie = await movie.save();
    res.status(201).json(savedMovie);
  } catch (error) {
    res.status(500).json({ message: 'Error adding movie', error });
  }
};

exports.getAllMovies = async (req, res) => {
  try {
    const movies = await Movie.find();
    res.status(200).json(movies);
  } catch (error) {
    res.status(500).json({ message: 'Error fetching movies', error });
  }
};

exports.getMovieById = async (req, res) => {
  const movie = await Movie.findById(req.params.id).populate('reviews.user', 'username');
  if (!movie) return res.status(404).json({ error: 'Кино олдсонгүй' });
  res.json(movie);
};

exports.addReview = async (req, res) => {
  const { comment, rating } = req.body;
  const movie = await Movie.findById(req.params.id);
  if (!movie) return res.status(404).json({ error: 'Кино олдсонгүй' });

  movie.reviews.push({
    user: req.user.id,
    comment,
    rating
  });

  await movie.save();
  res.json({ message: 'Шүүмж нэмэгдлээ' });
};
