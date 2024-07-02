--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2 (Debian 16.2-1.pgdg120+2)
-- Dumped by pg_dump version 16.2 (Debian 16.2-1.pgdg120+2)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.categories (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    active integer DEFAULT 1 NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.categories OWNER TO shopexpert;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO shopexpert;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: category_taxes; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.category_taxes (
    id integer NOT NULL,
    category_id integer NOT NULL,
    tax_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.category_taxes OWNER TO shopexpert;

--
-- Name: category_taxes_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.category_taxes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.category_taxes_id_seq OWNER TO shopexpert;

--
-- Name: category_taxes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.category_taxes_id_seq OWNED BY public.category_taxes.id;


--
-- Name: product_sale; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.product_sale (
    id integer NOT NULL,
    product_id integer NOT NULL,
    sale_id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.product_sale OWNER TO shopexpert;

--
-- Name: product_sale_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.product_sale_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.product_sale_id_seq OWNER TO shopexpert;

--
-- Name: product_sale_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.product_sale_id_seq OWNED BY public.product_sale.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.products (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    price double precision NOT NULL,
    category_id integer NOT NULL,
    active integer DEFAULT 1 NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.products OWNER TO shopexpert;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.products_id_seq OWNER TO shopexpert;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: sales; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.sales (
    id integer NOT NULL,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.sales OWNER TO shopexpert;

--
-- Name: sales_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.sales_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sales_id_seq OWNER TO shopexpert;

--
-- Name: sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.sales_id_seq OWNED BY public.sales.id;


--
-- Name: taxes; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.taxes (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    rate numeric(5,2),
    region character varying(255)
);


ALTER TABLE public.taxes OWNER TO shopexpert;

--
-- Name: taxes_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.taxes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.taxes_id_seq OWNER TO shopexpert;

--
-- Name: taxes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.taxes_id_seq OWNED BY public.taxes.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: shopexpert
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    active integer DEFAULT 1 NOT NULL,
    last_access timestamp without time zone,
    created_at timestamp without time zone DEFAULT now()
);


ALTER TABLE public.users OWNER TO shopexpert;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: shopexpert
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO shopexpert;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: shopexpert
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: category_taxes id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.category_taxes ALTER COLUMN id SET DEFAULT nextval('public.category_taxes_id_seq'::regclass);


--
-- Name: product_sale id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.product_sale ALTER COLUMN id SET DEFAULT nextval('public.product_sale_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: sales id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.sales ALTER COLUMN id SET DEFAULT nextval('public.sales_id_seq'::regclass);


--
-- Name: taxes id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.taxes ALTER COLUMN id SET DEFAULT nextval('public.taxes_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.categories (id, name, active, created_at) FROM stdin;
4	Carros	1	2024-06-30 00:15:37.19983
11	Motos	1	2024-06-30 12:49:20.847552
12	Bicicletas	1	2024-06-30 12:49:30.740522
14	Cigarros	1	2024-06-30 12:52:39.881248
13	Videogames	1	2024-06-30 12:52:32.051237
\.


--
-- Data for Name: category_taxes; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.category_taxes (id, category_id, tax_id, created_at) FROM stdin;
8	4	2	2024-07-01 01:36:20.175558
10	11	2	2024-07-01 01:36:34.251666
15	4	1	2024-07-01 16:00:44.648361
17	14	1	2024-07-02 12:39:18.902998
18	14	4	2024-07-02 12:39:20.115408
19	14	5	2024-07-02 12:39:21.45976
20	14	6	2024-07-02 12:39:22.859956
21	12	4	2024-07-02 12:40:15.792425
22	12	1	2024-07-02 12:40:17.067027
23	12	6	2024-07-02 12:40:21.987073
24	12	5	2024-07-02 12:40:39.711683
25	13	4	2024-07-02 12:41:21.0278
26	13	1	2024-07-02 12:41:22.152894
27	13	5	2024-07-02 12:41:23.522108
28	13	6	2024-07-02 12:41:25.402456
29	4	4	2024-07-02 12:41:59.732646
30	4	5	2024-07-02 12:42:00.92098
31	4	6	2024-07-02 12:42:02.10823
32	11	4	2024-07-02 12:42:06.055102
33	11	5	2024-07-02 12:42:07.013968
34	11	1	2024-07-02 12:42:08.045612
35	11	6	2024-07-02 12:42:09.911414
36	13	7	2024-07-02 12:43:30.833548
37	14	7	2024-07-02 12:43:34.30979
\.


--
-- Data for Name: product_sale; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.product_sale (id, product_id, sale_id, created_at) FROM stdin;
1	2	8	2024-07-02 14:46:02.267885
2	5	8	2024-07-02 14:46:02.267885
3	2	9	2024-07-02 15:09:36.275101
4	3	9	2024-07-02 15:09:36.275101
5	5	9	2024-07-02 15:09:36.275101
6	4	9	2024-07-02 15:09:36.275101
7	2	9	2024-07-02 15:09:36.275101
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.products (id, name, description, price, category_id, active, created_at) FROM stdin;
1	Nissan Versa	Motor 1.0 | Flex | 0KM	40000	4	1	2024-06-30 17:41:28.806156
2	Argo Drive	Motor 1.0 | Flex | 0KM	35000	4	1	2024-06-30 17:41:55.283914
3	Faze 250	Moto 250 CL | Flex | 0KM | Azul	19000	11	1	2024-06-30 17:42:51.909794
6	PlayStation 5	Slim | 1TB | Spider Man 2 | Branco	1699	13	1	2024-06-30 17:50:03.331966
7	XBOX Series X	1 TB SSD | 1 Controle S/Fio | 8 Core | Preto	2899	13	1	2024-06-30 17:51:16.996612
4	Malboro	Sem Sabor | Vermelho | 20 un	7.89	14	1	2024-06-30 17:43:37.272787
5	Caloi Highlevel	Aro 26 | Aluminio | Preta	675.2	12	1	2024-06-30 17:45:07.070174
\.


--
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.sales (id, created_at) FROM stdin;
8	2024-07-02 14:46:02.267885
9	2024-07-02 15:09:36.275101
\.


--
-- Data for Name: taxes; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.taxes (id, name, rate, region) FROM stdin;
2	IPVA	0.04	MT
4	PIS	0.02	MT
1	ICMS	0.13	MT
5	COFINS	0.08	MT
6	IPI	0.30	MT
7	II (Importação)	0.35	MT
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: shopexpert
--

COPY public.users (id, name, email, password, active, last_access, created_at) FROM stdin;
1	admin	admin@admin.com	$2y$10$d/jodesdEdVAmbwgrH.GA.O1FaB47mAwCiI1IGmW.q2xcnc5G1foy	1	2024-06-29 19:18:24.818491	2024-06-29 19:18:24.818491
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.categories_id_seq', 22, true);


--
-- Name: category_taxes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.category_taxes_id_seq', 37, true);


--
-- Name: product_sale_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.product_sale_id_seq', 7, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.products_id_seq', 8, true);


--
-- Name: sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.sales_id_seq', 9, true);


--
-- Name: taxes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.taxes_id_seq', 7, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: shopexpert
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: category_taxes category_taxes_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.category_taxes
    ADD CONSTRAINT category_taxes_pkey PRIMARY KEY (id);


--
-- Name: product_sale product_sale_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.product_sale
    ADD CONSTRAINT product_sale_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: sales sales_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pkey PRIMARY KEY (id);


--
-- Name: taxes taxes_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: category_taxes category_id; Type: FK CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.category_taxes
    ADD CONSTRAINT category_id FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: product_sale product_sale_product_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.product_sale
    ADD CONSTRAINT product_sale_product_id_fkey FOREIGN KEY (product_id) REFERENCES public.products(id);


--
-- Name: product_sale product_sale_sale_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.product_sale
    ADD CONSTRAINT product_sale_sale_id_fkey FOREIGN KEY (sale_id) REFERENCES public.sales(id);


--
-- Name: products products_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id);


--
-- Name: category_taxes tax_id; Type: FK CONSTRAINT; Schema: public; Owner: shopexpert
--

ALTER TABLE ONLY public.category_taxes
    ADD CONSTRAINT tax_id FOREIGN KEY (tax_id) REFERENCES public.taxes(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

