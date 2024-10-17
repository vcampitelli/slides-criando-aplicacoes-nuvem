import React from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Navbar from './layout/Navbar';
import UsersList from './UsersList';
import UsersCreate from './UsersCreate';
import Home from './Home';

function App () {
    return (
        <BrowserRouter>
            <Navbar/>
            <div className="container mt-5">
                <Routes>
                    <Route path="/" element={<Home/>}/>
                    <Route path="/users" element={<UsersList/>}/>
                    <Route path="/users/create" element={<UsersCreate/>}/>
                </Routes>
            </div>
        </BrowserRouter>
    );
}

export default App;
