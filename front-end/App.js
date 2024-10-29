import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'; // Use Routes instead of Switch
import ProductList from './pages/ProductList';
import AddProduct from './pages/AddProduct';

function App() {
  return (
    <Router>
      <Routes>
        <Route exact path="/" element={<ProductList />} />  {/* Use element instead of component */}
        <Route path="/add-product" element={<AddProduct />} />  {/* Use element instead of component */}
      </Routes>
    </Router>
  );
}

export default App;
