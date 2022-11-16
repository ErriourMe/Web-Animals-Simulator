interface IColors {
  primary: string | Record<string | number, string>;
  lightblue: string | Record<string | number, string>;
  blue: string | Record<string | number, string>;
  brown: string | Record<string | number, string>;
}

export const colors: IColors = {
  primary: {
    DEFAULT: "#00d67c",
    "50": "#32ffae",
    "100": "#28fea4",
    "200": "#1ef49a",
    "300": "#14ea90",
    "400": "#0ae086",
    "500": "#00d67c",
    "600": "#00cc72",
    "700": "#00c268",
    "800": "#00b85e",
    "900": "#00ae54",
  },
  lightblue: {
    DEFAULT: "#e0f7fa",
    "50": "#ffffff",
    "100": "#ffffff",
    "200": "#feffff",
    "300": "#f4ffff",
    "400": "#eaffff",
    "500": "#e0f7fa",
    "600": "#d6edf0",
    "700": "#cce3e6",
    "800": "#c2d9dc",
    "900": "#b8cfd2",
  },
  blue: {
    DEFAULT: "#80deea",
    "50": "#b2ffff",
    "100": "#a8ffff",
    "200": "#9efcff",
    "300": "#94f2fe",
    "400": "#8ae8f4",
    "500": "#80deea",
    "600": "#76d4e0",
    "700": "#6ccad6",
    "800": "#62c0cc",
    "900": "#58b6c2",
  },
  brown: {
    "50": "#d7ccc8",
    "100": "#664f4b",
    "200": "#5c4541",
    "300": "#523b37",
    "400": "#48312d",
    "500": "#3e2723",
    "600": "#341d19",
    "700": "#2a130f",
    "800": "#200905",
    "900": "#160000",
  },
};
