using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Tiles.Controllers
{
    public class CatalogController : Controller
    {
        // GET: Catalog
        public ActionResult Sanitary()
        {
            return View();
        }

        public ActionResult Tiles()
        {
            return View();
        }
    }
}