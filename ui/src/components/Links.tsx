import React from 'react';
import {Link} from "react-router-dom";
import ls from './styles/linksStyle.module.css';

export default function Links() {
    return (
        <div className={ls.linkGroup}>
            <Link className={ls.linkButton} to="/fruits">Fruits</Link>
            <Link className={ls.linkButton} to="/favoriteFruits">FavoriteFruits</Link>
        </div>
    )
}