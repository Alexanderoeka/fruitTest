import React from "react";
import Table from "../components/Table";
import SearchField from "../components/SearchField";
import fs from "./fruitsStyle.module.css";

export default function Fruits() {
    return (
        <div>
            FRUITS
            <div className={fs.search}>
                <SearchField/>
                <Table/>
            </div>


        </div>
    )
}