--
-- PostgreSQL database dump
--

-- Dumped from database version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.6 (Ubuntu 10.6-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: gallery; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.gallery (
    id character varying(32) NOT NULL,
    img character varying(255),
    description character varying(255)
);


ALTER TABLE public.gallery OWNER TO postgres;

--
-- Name: gallery_tags; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.gallery_tags (
    gallery_id character varying(32) NOT NULL,
    tags_id integer NOT NULL
);


ALTER TABLE public.gallery_tags OWNER TO postgres;

--
-- Name: news; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.news (
    id integer NOT NULL,
    slug character varying(255),
    preview character varying(255),
    created_at timestamp without time zone,
    header character varying(255),
    content text
);


ALTER TABLE public.news OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.news_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.news_id_seq OWNER TO postgres;

--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- Name: tags; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tags (
    id integer NOT NULL,
    name character varying(255)
);


ALTER TABLE public.tags OWNER TO postgres;

--
-- Name: tags_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tags_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tags_id_seq OWNER TO postgres;

--
-- Name: tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tags_id_seq OWNED BY public.tags.id;


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- Name: tags id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags ALTER COLUMN id SET DEFAULT nextval('public.tags_id_seq'::regclass);


--
-- Data for Name: gallery; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.gallery (id, img, description) FROM stdin;
5c8c0cc12f913	image1.jpg	Изображение 1
5c8c0cc12fbdd	image2.jpg	Изображение 2
5c8c0cc130c3e	image3.jpg	Изображение 3
5c8c0cc130d5e	image4.jpg	Изображение 4
5c8c0cc130e08	image5.jpg	Изображение 5
5c8c0cc130ebe	image6.jpg	Изображение 6
5c8c0cc130f75	image7.jpg	Изображение 7
5c8c0cc131027	image8.jpg	Изображение 8
5c8c0cc1310dd	image9.jpg	Изображение 9
5c8c0cc13118b	image10.jpg	Изображение 10
\.


--
-- Data for Name: gallery_tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.gallery_tags (gallery_id, tags_id) FROM stdin;
5c8c0cc12f913	1
5c8c0cc12f913	3
5c8c0cc12f913	4
5c8c0cc12fbdd	1
5c8c0cc12fbdd	2
5c8c0cc12fbdd	7
5c8c0cc130c3e	3
5c8c0cc130c3e	4
5c8c0cc130d5e	3
5c8c0cc130d5e	7
5c8c0cc130e08	1
5c8c0cc130e08	3
5c8c0cc130ebe	2
5c8c0cc130ebe	4
5c8c0cc130ebe	1
5c8c0cc130f75	1
5c8c0cc130f75	2
5c8c0cc130f75	3
5c8c0cc131027	6
5c8c0cc131027	7
5c8c0cc1310dd	2
5c8c0cc1310dd	5
5c8c0cc1310dd	7
5c8c0cc13118b	2
5c8c0cc13118b	3
5c8c0cc13118b	4
\.


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.news (id, slug, preview, created_at, header, content) FROM stdin;
2	dbgy	image1.jpg	2019-03-15 23:22:03.713069	Новость 1	Текст новости 1
3	fkrj	image2.jpg	2019-03-15 23:22:03.713069	Новость 2	Текст новости 2
4	pmew	image3.jpg	2019-03-15 23:22:03.713069	Новость 3	Текст новости 3
5	f4d1	image4.jpg	2019-03-15 23:22:03.713069	Новость 4	Текст новости 4
6	ph45	image5.jpg	2019-03-15 23:22:03.713069	Новость 5	Текст новости 5
7	lgsk	image6.jpg	2019-03-15 23:22:03.713069	Новость 6	Текст новости 6
\.


--
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tags (id, name) FROM stdin;
2	Тег 2
3	Тег 3
4	Тег 4
5	Тег 5
6	Тег 6
7	Тег 7
1	Тег 1
\.


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.news_id_seq', 7, true);


--
-- Name: tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tags_id_seq', 7, true);


--
-- Name: gallery gallery_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gallery
    ADD CONSTRAINT gallery_pkey PRIMARY KEY (id);


--
-- Name: gallery_tags gallery_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.gallery_tags
    ADD CONSTRAINT gallery_tags_pkey PRIMARY KEY (gallery_id, tags_id);


--
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: tags tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_pkey PRIMARY KEY (id);


--
-- Name: TABLE gallery; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.gallery TO dbuser;


--
-- Name: TABLE gallery_tags; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.gallery_tags TO dbuser;


--
-- Name: TABLE news; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.news TO dbuser;


--
-- Name: TABLE tags; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.tags TO dbuser;


--
-- PostgreSQL database dump complete
--

