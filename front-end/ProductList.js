import React, { useEffect, useState } from 'react';

const ProductList = () => {
    const [products, setProducts] = useState([]);

    useEffect(() => {
        fetch('http://localhost/backend/')
            .then(response => response.json())
            .then(data => setProducts(data));
    }, []);

    return (
        <div>
            <h1>Product List</h1>
            {products.map(product => (
                <div key={product.sku}>
                    <h2>{product.name} (${product.price})</h2>
                    <p>{product.type}: {product.type === 'DVD' ? product.size + ' MB' : 
                                        product.type === 'Book' ? product.weight + ' Kg' : 
                                        product.height + 'x' + product.width + 'x' + product.length}</p>
                </div>
            ))}
        </div>
    );
};

export default ProductList;
