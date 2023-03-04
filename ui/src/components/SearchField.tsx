import React from "react";
import sfs from './styles/searchFieldStyle.module.css';
import Input from "./parts/Input";
import {Buffer} from "buffer";
import Button from "./parts/Button";

interface propsI {
    value: string | number | undefined,
    onChange: (e: any)=>void,
    onSubmit: ()=>void
}

export default function SearchField(props: propsI) {
    const {onChange, onSubmit}= props;
    return (
        <div className={sfs.box}>
            <Input onChange={onChange} value={props.value}/>
            <Button onSubmit={onSubmit} value="Search" />

        </div>
    )
}