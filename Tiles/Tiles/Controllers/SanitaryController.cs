using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Tiles.Controllers
{
    public class SanitaryController : Controller
    {
        // GET: Sanitary
        public ActionResult BasinSeries()
        {
            return View();
        }

        public ActionResult BathTub()
        {
            return View();
        }

        public ActionResult Accessories()
        {
            return View();
        }

        public ActionResult Faucet()
        {
            return View();
        }

        public ActionResult ToiletSeries()
        {
            return View();
        }
    }
}