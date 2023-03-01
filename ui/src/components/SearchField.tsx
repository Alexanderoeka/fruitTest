import React from "react";
import sfs from './styles/searchFieldStyle.module.css';
import Input from "./parts/Input";
import {Buffer} from "buffer";
import Button from "./parts/Button";

interface propsI {
    value?: string | number | undefined
}

export default function SearchField(props: propsI) {

    return (
        <div className={sfs.box}>
            <Input value={props.value}/>
            <Button value="Search" />

        </div>
    )
}