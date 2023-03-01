import React from 'react';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Fruits from "../pages/Fruits";
import FavoriteFruits from "../pages/FavoriteFruits";
import Links from "../components/Links";

export default function Routing() {
    return (
        <Router>
            <Links/>
            <Routes>
                <Route path="/" element={<Fruits/>}/>
                <Route path="/fruits" element={<Fruits/>}/>
                <Route path="/favoriteFruits" element={<FavoriteFruits/>}/>
            </Routes>
        </Router>
    );
}