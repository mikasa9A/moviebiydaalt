const mongoose = require('mongoose');

const connectDB = async () => {
  try {
    await mongoose.connect(process.env.MONGO_URI);
    console.log('MongoDB холбогдлоо');
  } catch (error) {
    console.error('DB холболт алдаа:', error.message);
    process.exit(1);
  }
};

module.exports = connectDB;