import React from 'react';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import FruitsPage from "../pages/FruitsPage";
import FavoriteFruitsPage from "../pages/FavoriteFruitsPage";
import Links from "../components/Links";

export default function Routing() {
    return (
        <Router>
            <Links/>
            <Routes>
                <Route path="/" element={<FruitsPage/>}/>
                <Route path="/fruits" element={<FruitsPage/>}/>
                <Route path="/favoriteFruits" element={<FavoriteFruitsPage/>}/>
            </Routes>
        </Router>
    );
}