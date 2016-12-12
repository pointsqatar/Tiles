using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Tiles.Controllers
{
    public class HomeController : Controller
    {
        public ActionResult Index()
        {
            ViewBag.BodyClass = "home featured";
            ViewBag.IsIndexActive = "current active";
            ViewBag.IsServiceActive = "";
            ViewBag.IsGalleryActive = "";
            ViewBag.IsAboutActive = "";
            ViewBag.IsContactActive = "";
            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.BodyClass = "all contact";
            ViewBag.IsIndexActive = "";
            ViewBag.IsServiceActive = "";
            ViewBag.IsGalleryActive = "";
            ViewBag.IsAboutActive = "";
            ViewBag.IsContactActive = "current active";
            return View();
        }

        public ActionResult Services()
        {
            ViewBag.BodyClass = "all article";
            ViewBag.IsIndexActive = "";
            ViewBag.IsServiceActive = "current active";
            ViewBag.IsGalleryActive = "";
            ViewBag.IsAboutActive = "";
            ViewBag.IsContactActive = "";
            return View();
        }

        public ActionResult Gallery()
        {
            ViewBag.BodyClass = "home featured";
            ViewBag.IsIndexActive = "";
            ViewBag.IsServiceActive = "";
            ViewBag.IsGalleryActive = "current active";
            ViewBag.IsAboutActive = "";
            ViewBag.IsContactActive = "";
            return View();
        }

        public ActionResult About()
        {
            ViewBag.BodyClass = "all category blog";
            ViewBag.IsIndexActive = "";
            ViewBag.IsServiceActive = "";
            ViewBag.IsGalleryActive = "";
            ViewBag.IsAboutActive = "current active";
            ViewBag.IsContactActive = "";
            return View();
        }
    }
}