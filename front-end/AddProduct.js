import React, { useState } from 'react';
import { useHistory } from 'react-router-dom';

const AddProduct = () => {
    const [sku, setSku] = useState('');
    const [name, setName] = useState('');
    const [price, setPrice] = useState('');
    const [productType, setProductType] = useState('DVD'); // default is DVD
    const [attributes, setAttributes] = useState({});
    const history = useHistory();

    const handleSubmit = async (e) => {
        e.preventDefault();

        const productData = {
            sku,
            name,
            price,
            type: productType,
            ...attributes
        };

        // Post the data to the backend to save the product
        const response = await fetch('http://localhost/backend/add-product.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(productData),
        });

        if (response.ok) {
            // After successful product addition, redirect to product list page
            history.push('/');
        } else {
            alert('Failed to save the product');
        }
    };

    const handleTypeChange = (e) => {
        setProductType(e.target.value);
        setAttributes({}); // Reset attributes when changing product type
    };

    // Dynamic attributes based on product type
    const handleAttributeChange = (e) => {
        const { id, value } = e.target;
        setAttributes((prevAttrs) => ({
            ...prevAttrs,
            [id]: value,
        }));
    };

    return (
        <div>
            <h1>Add Product</h1>
            <form id="product_form" onSubmit={handleSubmit}>
                <div>
                    <label htmlFor="sku">SKU</label>
                    <input id="sku" value={sku} onChange={(e) => setSku(e.target.value)} required />
                </div>
                <div>
                    <label htmlFor="name">Name</label>
                    <input id="name" value={name} onChange={(e) => setName(e.target.value)} required />
                </div>
                <div>
                    <label htmlFor="price">Price ($)</label>
                    <input id="price" value={price} onChange={(e) => setPrice(e.target.value)} required />
                </div>
                <div>
                    <label htmlFor="productType">Product Type</label>
                    <select id="productType" value={productType} onChange={handleTypeChange}>
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>

                {productType === 'DVD' && (
                    <div>
                        <label htmlFor="size">Size (MB)</label>
                        <input id="size" onChange={handleAttributeChange} required />
                    </div>
                )}
                {productType === 'Book' && (
                    <div>
                        <label htmlFor="weight">Weight (Kg)</label>
                        <input id="weight" onChange={handleAttributeChange} required />
                    </div>
                )}
                {productType === 'Furniture' && (
                    <div>
                        <label htmlFor="height">Height (cm)</label>
                        <input id="height" onChange={handleAttributeChange} required />
                        <label htmlFor="width">Width (cm)</label>
                        <input id="width" onChange={handleAttributeChange} required />
                        <label htmlFor="length">Length (cm)</label>
                        <input id="length" onChange={handleAttributeChange} required />
                    </div>
                )}

                <button type="submit">Save</button>
                <button type="button" onClick={() => history.push('/')}>Cancel</button>
            </form>
        </div>
    );
};

export default AddProduct;
