import { LinksFunction } from "remix";
import stylesUrl from "~/styles/index.css";

import Main from "./components/main";
import Navbar from "./components/navbar";
import About from "./components/about";
import Something from "./components/something";
import Tournaments from "./components/tournaments";
import News from "./components/news";
import Ender from "./components/ender";

export const links: LinksFunction = () => {
  return [{ rel: "stylesheet", href: stylesUrl }];
};

export default function Index() {
  return (
    <div>
      <Main/>
      <Navbar/>
      <About/>
      <Something/>
      <Tournaments/>
      <News/>
      <Ender/>
    </div>
  );
}
